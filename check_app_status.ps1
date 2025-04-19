# Discord Webhook URL
$webhookUrl = "https://discordapp.com/api/webhooks/1363180595303284816/HAOArXO7QfKy_jjWQQdP7NEwEFuiyHkFdlqpOGsKQqI4KnxKPK9cYllWzeMmFmR-E0o4"

# Online application URL
$appUrl = "https://hackableapp.rf.gd/"

# Function to get current timestamp
function Get-Timestamp {
    return Get-Date -Format "yyyy-MM-dd HH:mm:ss"
}

# Function to check application status
function Check-AppStatus {
    try {
        $response = Invoke-WebRequest -Uri $appUrl -Method Get -TimeoutSec 30
        if ($response.StatusCode -eq 200) {
            return "Running (HTTP 200)"
        } else {
            return "Not Running (HTTP $($response.StatusCode))"
        }
    } catch {
        return "Error: $($_.Exception.Message)"
    }
}

# Get timestamp and status
$timestamp = Get-Timestamp
$status = Check-AppStatus

# Prepare Discord message
$message = "Online application status check completed successfully at $timestamp. URL: $appUrl. Status: $status"
$body = @{
    content = $message
} | ConvertTo-Json

# Send notification to Discord
try {
    Invoke-RestMethod -Uri $webhookUrl -Method Post -Body $body -ContentType "application/json"
    Write-Output "Notification sent to Discord: $message"
} catch {
    Write-Output "Failed to send notification: $($_.Exception.Message)"
}