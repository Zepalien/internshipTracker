<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use DateTime;
use DOMDocument;
use DOMXPath;

use Cake\Event\EventInterface;

class DashboardController extends AppController
{
    // TAMBAH KOD INI:
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Jika awak guna plugin Authentication, baris bawah ni sangat penting!
        if (isset($this->Authentication)) {
            // Kita benarkan akses ke index dashboard untuk testing
            $this->Authentication->addUnauthenticatedActions(['index']);
        }
    }

    public function index()
    {
        $applicationsTable = $this->fetchTable('Applications');
        $documentsTable = $this->fetchTable('Documents');

        // 1. Kira statistik utama
        $totalApplied = $applicationsTable->find()->count();
        $totalInterviews = $applicationsTable->find()->where(['status' => 2])->count();
        $totalOffers = $applicationsTable->find()->where(['status' => 1])->count();
        $totalRejected = $applicationsTable->find()->where(['status' => 3])->count();
        $pureApplied = $applicationsTable->find()->where(['status' => 0])->count();
        $totalDocuments = $documentsTable->find()->count();

        // 2. Ambil interview yang paling dekat (Next Interview)
        $nextInterview = $applicationsTable->find()
            ->where([
                'status' => 2,
                'interview_date IS NOT NULL',
                'interview_date >=' => new DateTime()
            ])
            ->order(['interview_date' => 'ASC'])
            ->first();

        // 3. Ambil permohonan terbaru untuk jadual
        $recentApplications = $applicationsTable->find()
            ->order(['created' => 'DESC'])
            ->limit(5)
            ->all();

        // 4. Hantar semua data ke View
        $this->set(compact(
            'totalApplied', 
            'totalInterviews', 
            'totalOffers', 
            'totalRejected', 
            'pureApplied', 
            'totalDocuments', 
            'recentApplications', 
            'nextInterview'
        ));
    }

    /**
     * API Endpoint untuk data pasaran real-time
     * Boleh diakses melalui JavaScript fetch('/dashboard/market-data')
     */
    public function marketData()
    {
        // Tutup pembayangan template View CakePHP kerana kita mahu pulangkan JSON sahaja
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');

        // Gunakan folder cache sementara CakePHP yang selamat
        $cacheFile = CACHE . 'market_cap_cache.json';
        $cacheTime = 3600; // Cache data selama 1 jam

        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
            $this->response = $this->response->withStringBody(file_get_contents($cacheFile));
            return $this->response;
        }

        // Fetch data via cURL
        $url = "https://companiesmarketcap.com/malaysia/largest-companies-in-malaysia-by-market-cap/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) ApplicationTracker/1.0');
        $html = curl_exec($ch);
        curl_close($ch);

        $fallbackData = [
            ["name" => "Maybank", "market_cap" => "25.4 B"],
            ["name" => "Public Bank", "market_cap" => "18.1 B"],
            ["name" => "CIMB Group", "market_cap" => "16.8 B"],
            ["name" => "Petronas Gas", "market_cap" => "8.3 B"],
            ["name" => "Tenaga Nasional", "market_cap" => "14.2 B"]
        ];

        if (!$html) {
            $this->response = $this->response->withStringBody(json_encode($fallbackData));
            return $this->response;
        }

        // Ekstrak data menggunakan DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $companyNodes = $xpath->query("//div[contains(@class, 'company-name')]");
        $capNodes = $xpath->query("//td[contains(@class, 'td-right') and not(contains(@class, 'rh-sm'))]");

        $extractedData = [];
        for ($i = 0; $i < min(5, $companyNodes->length); $i++) {
            $extractedData[] = [
                "name" => trim($companyNodes->item($i)->nodeValue),
                "market_cap" => trim($capNodes->item($i)->nodeValue)
            ];
        }

        if (empty($extractedData)) {
            $extractedData = $fallbackData;
        }

        $jsonData = json_encode($extractedData);
        file_put_contents($cacheFile, $jsonData);

        $this->response = $this->response->withStringBody($jsonData);
        return $this->response;
    }
}