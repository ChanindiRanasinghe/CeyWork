# CEYWork — Enterprise HR Management & Statutory Payroll System

<p align="center">
  <strong>Modern, Compliant, Agentic HRMS Tailored for Sri Lankan Enterprises</strong>
</p>

CEYWork is a production-grade Human Resource Management and Payroll Portal engineered with **Laravel 13**, **Livewire 4**, and **Tailwind CSS v4**. It features end-to-end employee lifecycle management, an automated Sri Lankan EPF/ETF statutory calculation engine, an Applicant Tracking System (ATS), and an embedded **Agentic AI Command Bar**.

---

## 🚀 Key Modules & Architecture

### 1. 🤖 Agentic AI Co-pilot & Command Bar (`Ctrl+K`)
- **Natural Language HR Assistant**: Global hotkey modal triggered via `Ctrl+K` or top navigation bar.
- **Autonomous ATS Candidate Screener**: Evaluates active applicants against job vacancy criteria and automatically updates stages.
- **Statutory Audit Engine**: Instant verification of 8% employee EPF, 12% employer EPF, and 3% ETF contributions.
- **Fast Entity Navigation**: Instant lookup for employees, leave requests, training programs, and assets.

### 2. 🇱🇰 Sri Lankan Statutory Payroll Engine
- **Automated EPF/ETF Calculations**: Compliant with the Employees' Provident Fund Act No. 15 of 1958 and Employees' Trust Fund Act No. 46 of 1980.
- **Statutory Form C3 Export**: Generates Department of Labour-compliant C3 Monthly Return CSV files.
- **Batch Processing**: Single-click payroll finalization across company departments with transaction locking.

### 3. 👥 Comprehensive Employee Lifecycle Management
- **Directory & Profiles**: Filterable employee register with National Identity Card (NIC), B-Card, EPF/ETF numbers, and bank account specifications.
- **Onboarding Hub**: Tracking of statutory Sri Lankan verification documents (Grama Niladhari Certificate, Police Clearance, B-Card registration).
- **Offboarding & Gratuity**: Gratuity Act calculations, IT clearance, asset recovery, and cessation notices (EPF Form K).

### 4. 🔒 Role-Based Access Control (RBAC) Matrix
- Dynamic permission matrix spanning 7 distinct tiers:
  - `System Administrator`
  - `Company Administrator`
  - `HR Manager (Senior)`
  - `HR Executive (Junior)`
  - `Department Manager`
  - `Interviewer`
  - `Employee`
- Dedicated Admin Portal for granular permission toggling and organizational department management.

### 5. 📊 Attendance, Performance & Training
- **Leave Management**: Tracking of statutory Annual (14 days), Casual (7 days), and Medical/Sick (14 days) leave balances with managerial approval workflows.
- **Performance & Appraisal**: Quarterly KPI targets, self-evaluations, and managerial scorecards.
- **Training Hub**: Course catalogs, compliance tracking, and automated completion verification.

---

## 🛠️ Technology Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | PHP 8.3+, Laravel 13 |
| **Reactive Frontend** | Livewire 4, Blade Components |
| **Styling & Design** | Tailwind CSS v4, PostCSS, CEYWork Design System |
| **Asset Pipeline** | Vite 8, Laravel Vite Plugin |
| **Database** | SQLite (testing & local), MySQL / PostgreSQL (production) |
| **Testing** | PHPUnit 12, Livewire Test Suite |
| **Version Control** | Git, GitHub |

---

## 🧪 Testing & Verification

CEYWork contains a comprehensive automated feature and unit testing suite covering all modules:

```bash
# Run the complete test suite
php artisan test

# Run specific module tests
php vendor/phpunit/phpunit/phpunit tests/Feature/AgenticAiTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/PayrollProcessorTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/EmployeeManagementTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/AttendanceDashboardTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/AdminPortalTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/AssetManagementTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/PerformanceDashboardTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/TrainingDashboardTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/OffboardingDashboardTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/ReportsAnalyticsTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/ProfileSettingsTest.php
php vendor/phpunit/phpunit/phpunit tests/Feature/EmployeeDashboardTest.php
```

---

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/ChanindiRanasinghe/CeyWork.git
   cd CeyWork
   ```

2. **Install PHP and Node dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate --seed
   ```

5. **Start Development Servers:**
   ```bash
   npm run dev
   php artisan serve
   ```

---

## 📄 License
The CEYWork HR Management System is proprietary software maintained by CEYWork Enterprise.
