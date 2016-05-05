<?php namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Media\Entities\File;

class MediaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hashes = [];
        $duplicates = [];
        foreach(glob(base_path('uploads/*')) as $_file) {

            $md5_file = md5_file($_file);
            if(in_array($md5_file, $hashes)) {
                $duplicates[] = $_file;
                continue;
            }

            $_fullpath = $_file;
            $file_ext = pathinfo($_fullpath, PATHINFO_EXTENSION);
            $mime = ($file_ext === 'jpg') ? 'image/jpeg' : 'image/png';

            $attrs = [
                'filename' => basename($_file),
                'path' => '/assets/media/' . basename($_file),
                'extension' => $file_ext,
                'mimetype' => $mime,
                'filesize' => filesize($_fullpath),

            ];

            File::create($attrs);

            $hashes[] = $md5_file;
        }
    }
}
