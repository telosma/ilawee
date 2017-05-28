<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Document;
use Log;
use Exception;

class ESMonthlyRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job-refresh-es:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Đánh lại chỉ mục dữ liệu trên Elasticsearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $count = Document::count();
            if ($count <= 500) {
                Document::addAllToIndex();
            } else {
                $part = intdiv($count, 500);

            }
            for ($i = 0; $i <= $part; $i++) {
                echo nl2br( "Đánh chỉ mục từ bản ghi" . ($i * 500) . "\n");
                if (($i == $part) && ($i*500 !== $count)) {
                    Document::skip($i* 500)->take($count - ($i * 500))->with(['docType', 'organizations', 'signers'])->get()->addToIndex();
                }

                Document::skip($i* 500)->take(500)->with(['docType', 'organizations', 'signers'])->get()->addToIndex();
            }

            echo nl2br("\n Hoành thành job cập nhật chỉ mục trong ES");
        } catch(Exception $e) {
            Log::error($e->getMessage);
            echo "Lỗi kết nối tới service ES";
        }
    }
}
