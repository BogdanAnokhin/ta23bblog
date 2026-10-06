@echo off
setlocal
cd /d "%~dp0"

set PHP_ROOT=C:\Users\ndban\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.4_Microsoft.WinGet.Source_8wekyb3d8bbwe
set PHP_EXE=%PHP_ROOT%\php.exe
set COMPOSER_EXE=C:\Users\ndban\AppData\Local\Composer\composer

if not exist "%PHP_EXE%" (
  echo PHP 8.4 not found at %PHP_EXE%
  exit /b 1
)

if not exist "%COMPOSER_EXE%" (
  echo Composer not found at %COMPOSER_EXE%
  exit /b 1
)

call :set_sqlite_env

"%PHP_EXE%" -d extension_dir="%PHP_ROOT%\ext" -d extension=fileinfo -d extension=openssl -d extension=curl -d extension=mbstring -d extension=zip -d extension=sqlite3 -d extension=pdo_mysql "%COMPOSER_EXE%" install --no-interaction
if errorlevel 1 exit /b %errorlevel%

"%PHP_EXE%" -d extension_dir="%PHP_ROOT%\ext" artisan key:generate --force
if errorlevel 1 exit /b %errorlevel%

"%PHP_EXE%" -d extension_dir="%PHP_ROOT%\ext" artisan migrate --force --seed
if errorlevel 1 exit /b %errorlevel%

echo.
echo Laravel project is ready.
exit /b 0

:set_sqlite_env
powershell -NoProfile -Command "$p = '.env'; $lines = Get-Content $p; $lines = $lines -replace 'DB_CONNECTION=mariadb','DB_CONNECTION=sqlite'; $lines = $lines -replace 'DB_DATABASE=blog','DB_DATABASE=database/database.sqlite'; $lines = $lines -replace 'DB_HOST=127.0.0.1','DB_HOST='; $lines = $lines -replace 'DB_PORT=33061','DB_PORT='; $lines = $lines -replace 'DB_USERNAME=root','DB_USERNAME='; $lines = $lines -replace 'DB_PASSWORD=example','DB_PASSWORD='; Set-Content -Path $p -Value $lines; if (-not (Test-Path 'database\database.sqlite')) { New-Item -ItemType File -Path 'database\database.sqlite' | Out-Null }"
exit /b 0
