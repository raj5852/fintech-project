<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupControler extends Controller
{
    function index()
    {
        $backupFileName = 'backup_' . time() . '.sql';

        // Set the appropriate headers for download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $backupFileName . '"');

        // Execute mysqldump and output the backup directly to the response
        $command = sprintf(
            'mysqldump -u%s -p%s %s',
            escapeshellarg(env('DB_USERNAME')),
            escapeshellarg(env('DB_PASSWORD')),
            escapeshellarg(env('DB_DATABASE'))
        );

        $descriptors = [
            0 => ['pipe', 'r'], // stdin
            1 => ['pipe', 'w'], // stdout
            2 => ['pipe', 'w'], // stderr
        ];

        $process = proc_open($command, $descriptors, $pipes);

        if (is_resource($process)) {
            // Read and output the backup file contents
            while (!feof($pipes[1])) {
                echo fread($pipes[1], 8192);
            }

            fclose($pipes[1]);

            // Clean up the temporary backup file
            unlink($backupFileName);

            proc_close($process);
        }
    }
}
