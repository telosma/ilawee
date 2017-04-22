<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;

use App\Models\{Signer, DocType, Document, FileStore, Organization, RelatedDocument};
use Carbon\Carbon;
use File;

class ImportDatabaseServiceProvider
{
    public function import()
    {
        /* Import organization data (Import truoc sau do den cac bang khac)*/
        // $organization_datas = json_decode(file_get_contents(storage_path('data_crawl') . "/organizations.json"), true);
        // foreach ($organization_datas as $row)
        // {
        //     $existOr = Organization::where('name', $row['name'])->first();
        //     if (empty($existOr)) {
        //         Organization::create($row);
        //     }
        // }
        /*-----------------------------------------*/

        /*----------------------------------------*/
        // $dir = storage_path('data_crawl');
        // $dataFolders = array_diff(scandir($dir, 1), array('..', '.'));
        // foreach ($dataFolders as $key => $folderPath) {
        //     if (is_dir($dir . "/" . $folderPath)) {
        //         // $filePaths = array_diff(scandir($dir . "/" . $folderPath), array('..', '.'));
        //         $fileText = glob($dir . "/" . $folderPath . "/*.txt");
        //         $fileJson = glob($dir . "/" . $folderPath . "/*.json");
        //         $filePdf =  glob($dir . "/" . $folderPath . "/*.pdf");

        //         $document_data = array();
        //         if (empty($fileTexts)) {
        //            $document_data['content'] = 'Đang cập nhật';
        //         } else {
        //             $document_data['content'] = file_get_contents($fileText[0]);
        //         }
        //         if (!empty($fileJson[0])) {
        //             $data = json_decode(file_get_contents($fileJson[0]), true);
        //             $document_data['item_id'] = $data['itemID'];
        //             $document_data['fields'] = $data['linhvuc'];
        //             $document_data['limit'] = $data['phamvi'];
        //             $document_data['notation'] = $data['sokihieu'];
        //             $document_data['publish_date'] = isset($document_data['publish_date']) ?
        //                 Carbon::createFromFormat('d/m/Y', $data['ngaybanhanh'])->toDateString() :
        //                 NULL;
        //             $document_data['start_date'] = isset($document_data['start_date']) ?
        //                 Carbon::createFromFormat('d/m/Y', $data['ngaycohieuluc'])->toDateString() :
        //                 NULL;
        //             $document_data['effective'] = $data['tinhtranghieuluc'];
        //             $document_data['description'] = $data['type'];
        //             $document_data['source'] = $data['nguonthuthap'];
        //             $document_data['confirmed'] = true;
        //             // Tao doctype
        //             $doc_type = Doctype::where('name', $data['loaivanban'])->first() ?
        //                         Doctype::where('name', $data['loaivanban'])->first() :
        //                         DocType::create([
        //                             'name' => $data['loaivanban']
        //                         ]);
        //             //Tao document thong qua doctype
        //             if ($doc_type) {
        //                 $document = $doc_type->documents()->create($document_data);
        //                 //Attaching / Detaching
        //                 for ($i = 1; $i < 4; $i ++)
        //                 {
        //                     if (isset($data['coquanbanhanh' . $i])) {
        //                         $coquanbanhanh = Organization::where('name', $data['coquanbanhanh' . $i])->first() ?
        //                             Organization::where('name', $data['coquanbanhanh' . $i])->first() :
        //                             Organization::create([
        //                                 'name' => $data['coquanbanhanh' . $i],
        //                                 'type' => 4
        //                             ]);
        //                         $signer = Signer::where('name', $data['nguoiki' . $i])->where('jobTitle', $data['chucdanh' . $i])->first();
        //                         if (empty($signer)) {
        //                             $signer = $coquanbanhanh->signers()->create([
        //                                 'name' => $data['nguoiki' . $i],
        //                                 'jobTitle' => $data['chucdanh' . $i]
        //                             ]);
        //                         }
        //                         $document->organizations()->attach($coquanbanhanh);
        //                         if (!$document->signers()->get()->contains('id', $signer->id)) {
        //                             $document->signers()->attach($signer);
        //                         };
        //                     }
        //                 }
        //             }
        //             if (!empty($filePdf)) {
        //                 if (!File::isDirectory(config('path.doc_store'))) {
        //                     File::makeDirectory(config('path.doc_store'), 0775, true);
        //                 }
        //                 $dest_file = config('path.doc_store') . "/" . basename($filePdf[0]);
        //                 File::copy($filePdf[0], $dest_file);
        //                 $file_store = $document->fileStore()->create([
        //                     'link' => $dest_file,
        //                     'key' => str_random(10)
        //                 ]);
        //             }
        //         }
        //     }
        // }
        /*-----------------------------------------*/
        /* Import Related Document sau khi da co cac ban document*/
        $dir = storage_path('data_crawl');
        $dataFolders = array_diff(scandir($dir, 1), array('..', '.'));
        foreach ($dataFolders as $key => $folderPath) {
            if (is_dir($dir . "/" . $folderPath)) {
                $fileJson = glob($dir . "/" . $folderPath . "/*.json");
                if (!empty($fileJson)) {
                    $data = json_decode(file_get_contents($fileJson[0]), true);
                    $vbcancuArray = [];
                    $vbduochuongdanArray = [];
                    $document = Document::where('item_id', $data['itemID'])->first();
                    if ($document) {
                        for ($i = 0; $i < 4; $i++) {
                            if (isset($data['vbcancu' . $i])) {
                                $vbcancu = Document::where('item_id', $data['vbcancu' . $i])->first();
                                $vbcancu = $vbcancu ? $vbcancu->id : NULL;
                                if ($vbcancu) {
                                    $vbcancuArray[] = $vbcancu;
                                }
                            }
                            if (isset($data['vbduochuongdan' . $i])) {
                                $vbduochuongdan = Document::where('item_id', $data['vbduochuongdan' . $i])->first();
                                $vbduochuongdan = $vbduochuongdan ? $vbduochuongdan->id : NULL;
                                if ($vbduochuongdan) {
                                    $vbduochuongdanArray[] = $vbduochuongdan;
                                }
                            }

                        }
                        $document->guideDocument()->attach($vbduochuongdanArray);
                        $document->baseDocument()->attach($vbcancuArray);
                    }
                }
            }
        }
        /**/

        // Testttttttttttt
                // if (is_dir(storage_path('data_crawl/100048'))) {
                //     $document_data = array();
                //     $document_data['content'] = '';
                //     foreach (glob(storage_path('data_crawl/100048') . "/*.txt") as $file) {
                //         // printf("file txt: " . $file . "\n");
                //         $document_data['content'] = file_get_contents($file);
                //     }

                //     $fileJson = glob(storage_path('data_crawl/100048') . "/*.json");
                //         // printf("file json: " . $file . "\n");
                //         $data = json_decode(file_get_contents($fileJson[0]), true);
                //         $document_data['item_id'] = $data['itemID'];
                //         $document_data['fields'] = $data['linhvuc'];
                //         $document_data['limit'] = $data['phamvi'];
                //         $document_data['notation'] = $data['sokihieu'];
                //         $document_data['publish_date'] = Carbon::createFromFormat('d/m/Y', $data['ngaybanhanh'])->toDateString();
                //         $document_data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['ngaycohieuluc'])->toDateString();
                //         $document_data['effective'] = $data['tinhtranghieuluc'];
                //         $document_data['description'] = $data['type'];
                //         $document_data['source'] = $data['nguonthuthap'];
                //         $document_data['confirmed'] = true;

                //     $doc_type = Doctype::where('name', $data['loaivanban'])->first() ?
                //                 Doctype::where('name', $data['loaivanban'])->first() :
                //                 DocType::create([
                //                     'name' => $data['loaivanban']
                //                 ]);
                //     if ($doc_type) {
                //         $document = $doc_type->documents()->create($document_data);
                //     }
                //     $filePdf = glob(storage_path('data_crawl/100048') . "/*.pdf");
                //         // printf("file txt: " . $file . "\n");
                //     if (!empty($filePdf)) {
                //         if (!File::isDirectory(config('path.doc_store'))) {
                //             File::makeDirectory(config('path.doc_store'), 0775, true);
                //         }
                //         $dest_file = config('path.doc_store') . "/" . basename($filePdf[0]);
                //         File::copy($file, $dest_file);
                //         $file_store = $document->fileStore()->create([
                //             'link' => $dest_file,
                //             'key' => str_random(10)
                //         ]);
                //     }
                // }
    }
}
?>
