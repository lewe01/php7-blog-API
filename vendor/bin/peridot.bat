@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../peridot-php/peridot/bin/peridot
php "%BIN_TARGET%" %*
