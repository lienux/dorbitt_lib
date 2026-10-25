<?php

namespace Dorbitt\Helpers;

use HeadlessChromium\Exception\OperationTimedOut;
use HeadlessChromium\BrowserFactory;
// use HeadlessChromium\Page;

class ChromePhpHelper {
	public function __construct()
    {
        // $this->client = \Config\Services::curlrequest();
        // $this->request = \Config\Services::request();
        $this->browserFactory = new BrowserFactory();
    }

	public function create($data)
    {
        $browser = $this->browserFactory->createBrowser(
            // [
            //     'windowSize'   => [1920, 1000],
            //     // 'enableImages' => false,
            // ]
        );
        $url = $data['url'];
        $name = $data['name'];
        $dir = $data['dir'];

        try {
            // creates a new page and navigate to an URL
            $page = $browser->createPage($url);
            $page->navigate($url)
            // $page->waitForNavigation(Page::DOM_CONTENT_LOADED, 60000);
            ->waitForNavigation();

            // get page title
            $pageTitle = $page->evaluate('document.title')->getReturnValue();

            // screenshot - Say "Cheese"! 😄
            // $page->screenshot()->saveToFile('img/'.$name.'.png');

            $options = [
                // 'landscape'           => true,             // default to false
                'printBackground'     => true,             // default to false
                // 'displayHeaderFooter' => true,             // default to false
                'preferCSSPageSize'   => true,             // default to false (reads parameters directly from @page)
                'marginTop'           => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginBottom'        => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginLeft'          => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginRight'         => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                // 'paperWidth'          => 6.0,              // defaults to 8.5 (must be a float, value in inches)
                // 'paperHeight'         => 6.0,              // defaults to 11.0 (must be a float, value in inches)
                // 'headerTemplate'      => '<div>foo</div>', // see details above
                // 'footerTemplate'      => '<div>foo</div>', // see details above
                // 'scale'               => 1.2,              // defaults to 1.0 (must be a float)
            ];

            // print as pdf (in memory binaries)
            $pdf = $page->pdf($options);

            // pdf
            // $page->pdf(['printBackground' => false])->saveToFile('/foo/bar.pdf');
            // $page->pdf(['printBackground' => true])->saveToFile('create_file/pdf/'.$name.'.pdf');
            $pdf->saveToFile($dir.$name);
        } finally {
            // bye
            $browser->close();
        }
    }

    public function create_v2($data)
    {
        // Data POST yang ingin kamu kirim ke URL target
        $url = $data['url'];
        $name = $data['name'];
        $dir = $data['dir'];

        // Start browser dengan argument tambahan jika diperlukan
        $browser = $this->browserFactory->createBrowser([
            'headless'        => true,
            'disableSandbox'  => true, 
            'customFlags'     => [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-namespace-sandbox',
                '--disable-extensions',
                '--disable-gpu',
                '--disable-dev-shm-usage', // Penting agar tidak crash karena limit memori di Linux
            ]
        ]);

        try {
            $page = $browser->createPage($url);
            $page->navigate($url)
                // ->waitForNavigation(Page::DOM_CONTENT_LOADED, 60000);
                ->waitForNavigation('networkIdle', 60000);
                // ->waitForNavigation();

            // get page title
            $pageTitle = $page->evaluate('document.title')->getReturnValue();

            // screenshot - Say "Cheese"! 😄
            // $page->screenshot()->saveToFile('img/'.$name.'.png');

            $options = [
                // 'landscape'           => true,             // default to false
                'printBackground'     => true,             // default to false
                // 'displayHeaderFooter' => true,             // default to false
                'preferCSSPageSize'   => true,             // default to false (reads parameters directly from @page)
                'marginTop'           => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginBottom'        => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginLeft'          => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginRight'         => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                // 'paperWidth'          => 6.0,              // defaults to 8.5 (must be a float, value in inches)
                // 'paperHeight'         => 6.0,              // defaults to 11.0 (must be a float, value in inches)
                // 'headerTemplate'      => '<div>foo</div>', // see details above
                // 'footerTemplate'      => '<div>foo</div>', // see details above
                // 'scale'               => 1.2,              // defaults to 1.0 (must be a float)
            ];

            // print as pdf (in memory binaries)
            $pdf = $page->pdf($options);

            // pdf
            // $page->pdf(['printBackground' => false])->saveToFile('/foo/bar.pdf');
            // $page->pdf(['printBackground' => true])->saveToFile('create_file/pdf/'.$name.'.pdf');
            $pdf->saveToFile($dir.$name);
        }
        finally {
            // Selalu tutup browser setelah selesai
            $browser->close();
        }
    }

    // menggunaka post
    public function create_v3($data)
    {
        // Data POST yang ingin kamu kirim ke URL target
        $url = $data['url'];
        $targetUrl = $data['url'];
        $dir = $data['dir'];
        $name = $data['name'];
        $row = $data['row'];
        $outputPath = $dir . $name;

        // Start browser dengan argument tambahan jika diperlukan
        $browser = $this->browserFactory->createBrowser([
            'headless'        => true,
            'disableSandbox'  => true, 
            'customFlags'     => [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-namespace-sandbox',
                '--disable-extensions',
                '--disable-gpu',
                '--disable-dev-shm-usage', // Penting agar tidak crash karena limit memori di Linux
            ]
        ]);

        try {
            // 2. Buat halaman baru dan buka halaman kosong awal
            $page = $browser->createPage();
            $page->navigate('about:blank')->waitForNavigation();

            // Konversi data array PHP ke JSON agar bisa dibaca oleh JavaScript
            $jsonPostData = json_encode($row);

            // 3. Suntikkan JavaScript untuk membuat & submit form POST secara otomatis
            $page->evaluate("
                (() => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '" . $targetUrl . "';

                    const data = " . $jsonPostData . ";
                    for (const key in data) {
                        if (data.hasOwnProperty(key)) {
                            const hiddenField = document.createElement('input');
                            hiddenField.type = 'hidden';
                            hiddenField.name = key;
                            hiddenField.value = data[key];
                            form.appendChild(hiddenField);
                        }
                    }

                    document.body.appendChild(form);
                    form.submit();
                })()
            ");

            // 4. Tunggu sampai halaman target selesai memuat (Timeout dinaikkan ke 30 detik / 30000ms)
            // 'networkIdle' memastikan semua aset seperti CSS dan gambar selesai diunduh
            $page->waitUntilContainsElement('body', 30000, 'networkIdle');

            // 5. Cetak ke PDF
            $pdfOptions = [
                // 'landscape'           => true,             // default to false
                'printBackground'     => true,             // default to false
                // 'displayHeaderFooter' => true,             // default to false
                'preferCSSPageSize'   => true,             // default to false (reads parameters directly from @page)
                'marginTop'           => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginBottom'        => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginLeft'          => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginRight'         => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                // 'paperWidth'          => 6.0,              // defaults to 8.5 (must be a float, value in inches)
                // 'paperHeight'         => 6.0,              // defaults to 11.0 (must be a float, value in inches)
                // 'headerTemplate'      => '<div>foo</div>', // see details above
                // 'footerTemplate'      => '<div>foo</div>', // see details above
                // 'scale'               => 1.2,              // defaults to 1.0 (must be a float)
            ];

            $pdf = $page->pdf($pdfOptions);
            
            // 6. Simpan file hasil cetak
            $pdf->saveToFile($outputPath);
        }
        finally {
            // Selalu tutup browser setelah selesai
            $browser->close();
        }
    }

    public function create_002($name)
    {
        $html = $this->request->getVar('html');
        $browser = $this->browserFactory->createBrowser();
        // $url = $data['url'];
        // $name = $data['name'];

        try {
            // // creates a new page and navigate to an URL
            // $page = $browser->createPage($url);
            $page = $browser->createPage();
            // $page->navigate($url)->waitForNavigation();

            // create from html
            $page->setHtml($html);

            // get page title
            $pageTitle = $page->evaluate('document.title')->getReturnValue();

            // screenshot - Say "Cheese"! 😄
            // $page->screenshot()->saveToFile('img/'.$name.'.png');

            // pdf
            // $page->pdf(['printBackground' => false])->saveToFile('/foo/bar.pdf');
            // $page->pdf(['printBackground' => true])->saveToFile('create_file/pdf/'.$name.'.pdf');
            $options = [
                // 'landscape'           => true,             // default to false
                'printBackground'     => true,             // default to false
                // 'displayHeaderFooter' => true,             // default to false
                'preferCSSPageSize'   => true,             // default to false (reads parameters directly from @page)
                'marginTop'           => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginBottom'        => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginLeft'          => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                'marginRight'         => 0.0,              // defaults to ~0.4 (must be a float, value in inches)
                // 'paperWidth'          => 6.0,              // defaults to 8.5 (must be a float, value in inches)
                // 'paperHeight'         => 6.0,              // defaults to 11.0 (must be a float, value in inches)
                // 'headerTemplate'      => '<div>foo</div>', // see details above
                // 'footerTemplate'      => '<div>foo</div>', // see details above
                // 'scale'               => 1.2,              // defaults to 1.0 (must be a float)
            ];

            // print as pdf (in memory binaries)
            $pdf = $page->pdf($options);

            // pdf
            // $page->pdf(['printBackground' => false])->saveToFile('/foo/bar.pdf');
            // $page->pdf(['printBackground' => true])->saveToFile('create_file/pdf/'.$name.'.pdf');
            $pdf->saveToFile('create_file/pdf/'.$name.'.pdf');
        } finally {
            // bye
            $browser->close();
        }
    }
}