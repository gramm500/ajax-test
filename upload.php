<?php
header('Content-type: application/json');
function returnData(bool $success, int $code, string $message, ?array $data = [])
{
    return print(json_encode([
        'data' => $data,
        'code' => $code,
        'message' => $message,
        'success' => $success
    ]));
}

function handleQuery()
{
    if (isset($_POST['is_form']) && (bool)isset($_POST['is_form'])) {
        $name = $_POST['name'];

        if (!empty($_FILES["file"]["name"])) {
            $targetDir = "uploads";
            $targetFile = $targetDir . '/' . md5((string)time()) . basename($_FILES["file"]["name"]);
            $file = fopen('txt.txt', 'a+');
            fwrite($file, $name . PHP_EOL);
            fclose($file);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                return returnData(true, 200, 'Not found', [
                    'file' => [
                        'name' => $name,
                        'path' => $targetFile
                    ]
                ]);
            }
        }

        return returnData(false, 404, 'Please add file');
    }

    return returnData(false, 404, 'Not found');
}

handleQuery();
exit();