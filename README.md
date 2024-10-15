## COVID Vaccine Registration System

This Laravel-based application manages COVID vaccine registrations, allowing users to register for vaccination at various centers. The system handles email notifications and SMS reminders for users.

### Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Migration and Seeding](#database-migration-and-seeding)
- [Running the Application](#running-the-application)
- [Sending Vaccination Emails and SMS](#sending-vaccination-emails-and-sms)
- [Contributing](#contributing)
- [Code of Conduct](#code-of-conduct)
- [Security Vulnerabilities](#security-vulnerabilities)
- [License](#license)

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 8.x
- Database (MySQL)

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/prodhan482/covid-vaccine-registration.git
    cd covid-vaccine-registration
    ```

2. **Install dependencies using Composer:**

    ```bash
    composer install
    ```

## Configuration

1. **Copy the `.env.example` file to `.env`:**

    ```bash
    cp .env.example .env
    ```

2. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

3. **Update your `.env` file** with your database and mail configuration. Here is an example configuration:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_mailtrap_username
    MAIL_PASSWORD=your_mailtrap_password
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=example@example.com
    MAIL_FROM_NAME="${APP_NAME}"

    TWILIO_SID=your_twilio_sid
    TWILIO_AUTH_TOKEN=your_twilio_auth_token
    TWILIO_PHONE_NUMBER=your_twilio_phone_number
    ```

### Additional Notes:

- Ensure you have the required database created in your DBMS.
- Adjust the email configuration according to your email service provider's settings.

## Database Migration and Seeding

1. **Run the migrations:**

    ```bash
    php artisan migrate
    ```

2. **Seed the database with vaccine centers:**

    ```bash
    php artisan db:seed
    ```

## Running the Application

1. **Start the local development server:**

    ```bash
    php artisan serve
    ```

2. **Open your browser** and visit [http://localhost:8000](http://localhost:8000).

## Sending Vaccination Emails and SMS

To send reminder emails and SMS for vaccinations scheduled for tomorrow, you can set up a cron job. Open your terminal and run:

```bash
crontab -e
```
After this add this 

```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

### Important Considerations:

****The application will automatically send reminder emails and SMS at 9 PM every day for vaccinations scheduled for the next day.

****Ensure you have set up your Twilio and Mailtrap configuration correctly to send SMS reminders.