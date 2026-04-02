# Portfolio ERP System - Project Documentation

## 1. Project Overview
This project is a comprehensive **Portfolio ERP (Enterprise Resource Planning)** system built with **Laravel** and **Filament PHP**. It serves a dual purpose:
1.  **Public Portfolio**: A professional showcase for the developer's work, services, and blog.
2.  **Business Management System**: A powerful backend to manage clients, projects, finances, and support tickets.

## 2. Technology Stack
-   **Framework**: Laravel 12.x
-   **Admin Panel**: Filament PHP 3.x
-   **Frontend**: Blade, Livewire, Volt, Tailwind CSS
-   **Database**: SQLite (Development), generic SQL support
-   **Permissions**: Spatie Laravel Permission
-   **File Management**: Spatie Media Library

## 3. Key Features

### 3.1. Public Facing (Frontend)
-   **Portfolio Showcase**: Display projects with details, images, and case studies.
-   **Blog/News**: Publish articles to engage visitors.
-   **Services**: List offered services.
-   **Contact/Leads**: Capture inquiries directly into the CRM.
-   **Localization**: Support for multiple languages (English, Spanish, Arabic).

### 3.2. Client Portal
-   **Secure Login**: Dedicated client authentication.
-   **Dashboard**: Overview of active projects and pending invoices.
-   **Project Tracking**: View project progress/status.
-   **Invoices**: Download and view invoice history.
-   **Support**: Submit and track support tickets.

### 3.3. Admin Panel (Filament)
The core of the system, accessible only to Admins/Staff.
-   **CRM (Customer Relationship Management)**:
    -   Manage **Leads** and convert them to **Clients**.
    -   Detailed Client profiles.
-   **Project Management**:
    -   **Projects**: Track milestones, deadlines, and status.
    -   **Tasks**: granular task management (To Do, In Progress, Done).
    -   **Time Logs**: Track hours spent on tasks for billing.
-   **Financial Management**:
    -   **Invoices**: Generate professional invoices with line items.
    -   **Payments**: Record payments against invoices.
    -   **Expenses**: Track business expenses to calculate net profit.
-   **Help Desk**:
    -   **Support Tickets**: Manage client issues with status tracking (Open, Closed).
-   **CMS (Content Management)**:
    -   Manage Portfolio Items and Blog Posts.
-   **Role-Based Access Control (RBAC)**:
    -   Define Roles (Admin, Manager, Client) and Permissions (view_projects, edit_invoices, etc.).

## 4. Database Schema Overview
The database is designed to support the ERP functionality. Key entities include:

-   **Users**: System users (Admins, Clients).
-   **Clients**: Business profiles linked to Users.
-   **Projects**: Main work units, linked to Clients.
-   **Tasks/TimeLogs**: Linked to Projects.
-   **Invoices/Payments**: distinct financial records linked to Clients/Projects.
-   **SupportTickets**: Issues raised by Users/Clients.
-   **Leads**: Potential clients.

## 5. System Design Principles
-   **Modular Architecture**: Features are grouped (Finance, PM, CMS).
-   **Secure by Design**: Policies and Gates ensure data privacy between clients.
-   **Scalable**: Built on Laravel, ready for growth.
