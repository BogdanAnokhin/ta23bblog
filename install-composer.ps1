$php = 'C:\Users\ndban\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.WinGet.Source_8wekyb3d8bbwe\php.exe'
$setup = Join-Path $env:TEMP 'composer-setup.php'
$composerDir = Join-Path $env:LOCALAPPDATA 'Composer'

Write-Host 'Checking PHP...'
& $php -v

Write-Host 'Downloading Composer installer...'
& $php -r 'copy("https://getcomposer.org/installer", $argv[1]);' $setup

Write-Host 'Installing Composer...'
New-Item -ItemType Directory -Force -Path $composerDir | Out-Null
& $php $setup --install-dir $composerDir --filename composer

$env:PATH += ';' + $composerDir
Write-Host "Composer installed at: $composerDir\composer.exe"
