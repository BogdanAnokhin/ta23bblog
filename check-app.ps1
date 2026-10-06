try {
    $response = Invoke-WebRequest -Uri 'http://127.0.0.1:8000' -Method Head -UseBasicParsing
    Write-Host "Status: $($response.StatusCode)"
    Write-Host "Content-Type: $($response.Headers['Content-Type'])"
}
catch {
    Write-Host $_.Exception.Message
    exit 1
}
