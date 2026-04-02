# 🚀 Ewas Portfolio | Full-Stack Developer
**A technical showcase of software engineering principles and web development skills.**

---

## 📋 Table of Contents | جدول المحتويات
* [Introduction        | مقدمة](#-introduction--مقدمة)
* [Tech Stack          | التقنيات المستخدمة](#-tech-stack--التقنيات-المستخدمة)
* [Key Features        | المميزات الرئيسية](#-key-features--المميزات-الرئيسية)
* [System Architecture | هيكلية النظام](#-system-architecture--هيكلية-النظام)
* [Database Design     | تصميم قاعدة البيانات](#-database-design--تصميم-قاعدة-البيانات)
* [How to Run          | كيفية التشغيل](#-how-to-run--كيفية-التشغيل)

---

## 🌟 Introduction | مقدمة
**English:** This portfolio is a professional representation of my journey as a Backend Developer. It is built to demonstrate my ability to handle full-stack workflows, focusing on scalability, clean code, and efficient database management using Laravel.

**العربية:** هذا الملف (Portfolio) هو تمثيل احترافي لمسيرتي كمطور خلفية (Backend Developer). تم بناؤه لاستعراض قدرتي على التعامل مع سير عمل التطوير الشامل، مع التركيز على قابلية التوسع، نظافة الكود، والإدارة الفعالة لقواعد البيانات باستخدام إطار عمل Laravel.

---

## 🛠 Tech Stack | التقنيات المستخدمة
* **Backend:** PHP 8.x & Laravel Framework.
* **Frontend:** Blade Template Engine, Tailwind CSS, JavaScript.
* **Database:** MySQL (Relational Mapping via Eloquent ORM).
* **Dev Environment:** Linux Ubuntu (Ubuntu LTS).
* **Version Control:** Git & GitHub.

---

## ✨ Key Features | المميزات الرئيسية
1.  **Dynamic Project Management:** Full CRUD operations to manage portfolio items.
2.  **Responsive UI:** Optimized for all screen sizes using modern CSS frameworks.
3.  **Secure Contact Form:** Integrated validation and mail handling.
4.  **Optimized Performance:** Utilizing Laravel's caching and optimization tools.

---

## 🏗 System Architecture | هيكلية النظام
**English:** The system architecture follows the **MVC (Model-View-Controller)** pattern. This ensures a strict separation between the business logic (Controllers), the data layer (Models), and the user interface (Views).

**العربية:** تتبع بنية النظام نمط **MVC**. يضمن ذلك فصلاً صارماً بين منطق العمل (Controllers)، وطبقة البيانات (Models)، وواجهة المستخدم (Views).

---

## 💾 Database Design | تصميم قاعدة البيانات
**English:** The project utilizes a relational database structure. Key tables include:
* `projects`: Stores metadata, images, and links.
* `skills`: Manages technical proficiencies.
* `messages`: Handles incoming inquiries from the contact form.

**العربية:** يعتمد المشروع على هيكلية قاعدة بيانات علائقية. تشمل الجداول الرئيسية:
* `projects`: لتخزين بيانات المشاريع والروابط.
* `skills`: لإدارة المهارات التقنية.
* `messages`: لمعالجة الرسائل الواردة من نموذج التواصل.

---

## 🚀 How to Run | كيفية التشغيل

1. **Clone the repository | استنساخ المستودع:**
   ```bash
   git clone [https://github.com/engAhmedEwas/Ewas-portfolio.git](https://github.com/engAhmedEwas/Ewas-portfolio.git)
   cd Ewas-portfolio
2. **Install Composer Dependencies | تثبيت مكتبات الملحن:**
   ```bash
   composer install
3. **Install NPM Dependencies | تثبيت مكتبات الواجهة:**
   ```bash
   npm install && npm run dev
4. **Environment Setup | إعداد ملف البيئة:**
   ```bash
   cp .env.example .env
   php artisan key:generate
5. **Database Migration | تهجير قاعدة البيانات:**
   ```bash
   php artisan migrate
6. **Serve the application | تشغيل الخادم:**
   ```bash
   php artisan serve

--------------------------------------------------------------------------------------------------------
Maintained by Ahmed Ewas
