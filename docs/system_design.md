# System Design / Architecture

```mermaid
graph TD
    Client[Client Browser] -->|HTTPS| WebServer[Web Server (Nginx)]
    WebServer -->|Request| AppServer[App Server (Laravel)]
    
    subgraph Data Layer
        AppServer -->|Read/Write| DB[(Database / SQLite)]
        AppServer -->|Cache| Cache[(Cache / File)]
    end
    
    subgraph Services
        AppServer -->|Queue| QueueWorker[Queue Worker]
        AppServer -->|Store Files| Storage[Local/S3 Storage]
        AppServer -->|Search| SearchEngine[MeiliSearch]
    end

    subgraph External
        AppServer -->|Email| MailServer[SMTP / Mailgun]
    end
```
