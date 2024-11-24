
# Insider Messaging Project

This project developed for Insider Assessment Project.

---

## Requirements

- PHP v8.3.*
- Laravel 11.*
- Redis
- MySQL
- Composer

---

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://www.github.com/rampesna/insiderMessagingApp.git
   cd insiderMessagingApp
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   - Copy `.env.example` to `.env` and configure the following:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=insider_messaging_app
     DB_USERNAME=YOUR_DB_USER
     DB_PASSWORD=YOUR_DB_PASSWORD

     REDIS_HOST=127.0.0.1
     REDIS_PASSWORD=null
     REDIS_PORT=6379
     ```

4. **Database Setup**
   - Run migrations to create the necessary tables:
     ```bash
     php artisan migrate
     ```
    - Seed the database with sample data:
      ```bash
        php artisan db:seed
      ```

5. **Queue Configuration**
   - Start the queue worker:
     ```bash
     php artisan queue:work redis
     ```

6. **Run the Application**
   - Start the development server:
     ```bash
     php artisan serve
     ```

---

## Usage

### Trigger Message Sending
- Use the following command to start sending unsent messages:
  ```bash
  php artisan messages:process
  ```

### API Endpoints
- **List Messages**
  - Endpoint: `/api/messages/index`
  - Method: `GET`
  - Parameters: `limit: int`, `isSent: 0|1`
  - Example: `http://localhost/api/messages/index?limit=10&isSent=1`
  - Response: List of messages.


- **Get Message By Id**
    - Endpoint: `/api/messages/getById`
    - Method: `GET`
    - Parameters: `id: int`
    - Example: `http://localhost/api/messages/index?limit=10&isSent=1`
    - Response: List of messages.


- **Get Message By Message Id**
    - Endpoint: `/api/messages/getByMessageId`
    - Method: `GET`
    - Parameters: `messageId: string`
    - Example: `http://localhost/api/messages/index?limit=10&isSent=1`
    - Response: List of messages.

---

## Deployment

1. **Production Configuration**
   - You must create cron jobs to run the `php artisan messages:process` command at regular intervals.

---

## License

This project is licensed under the [MIT License](LICENSE).
