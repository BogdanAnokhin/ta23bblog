$path = 'C:\Users\ndban\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.WinGet.Source_8wekyb3d8bbwe\php.ini'
$php = 'C:\Users\ndban\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.WinGet.Source_8wekyb3d8bbwe\php.exe'
$lines = @(
  '[PHP]',
  'extension_dir = "C:\Users\ndban\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.WinGet.Source_8wekyb3d8bbwe\ext"',
  'extension=curl',
  'extension=openssl',
  'extension=mbstring',
  'extension=fileinfo',
  'extension=pdo_sqlite',
  'extension=sqlite3',
  'extension=zip'
)
[System.IO.File]::WriteAllLines($path, $lines)
& $php -m | Select-String 'mbstring|pdo_sqlite|sqlite3|curl|openssl|fileinfo|zip'
