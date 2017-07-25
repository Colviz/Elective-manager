## Elective Manager New
> This is the Elective Manager which will be used for Elective allotments (Open electives as well as Departmental electives). <br>
> Develop it keeping in mind its **Flexibility**, **Stability** and **Security**.

run as `php -S localhost:3000`

## Project Completed - **36/45 - 80%**
Calculated from Features to Implement completion percentage.

## Languages and Packages used -
> PHP, Javascript, MySql, Google Material Design, PHP-API (self created)

## Features to Implement

### **General**
- [x] Add captcha on every form.
- [x] Should work for both Open elective as well as Departmental elective allotments.
- [x] Should have a secure password recovery mechanism for all the interfaces.
- [x] 3 login interfaces - **Admin**, **Student** and **Department**.
- [x] Do routing.
- [x] Use OOP and functions to get the work done.
- [x] Use Javascript for field validations.
- [x] Responsive Design.
- [x] Open source this project and provide long term support.
- [x] Prevent attacks eg. Sql Injections (Use PDO, prepare queries, mysqli_real_escape_string(), stripslashes()).
- [x] Avoid code redundancy.
- [x] All design etc. files common for all interfaces should be put together, reduces redundancy.
- [x] Use google API for sending all kinds of mails - used mailgun (opensource).
- [x] Make a report bugs page, it's link should be on the footer, while reporting a bug if the session is set then also send the name of session user in the report.
- [x] Make an interactive 404 error page, can also display the names of developers on the page.
- [x] Footer should have a credits link also.
- [ ] Add page hits counter
- [x] All the open forms (can be accessed without login, eg. bugs) should have a captcha.
- [ ] Add instructions,faq page.

### **Admin Interface**
- [ ] Gets the final list of students selected for each elective.
- [ ] Gets the notification when department deletes an elective/closes registration.
- [x] Can see all the available departments.
- [x] Can see all the departments with no. of published electives.
- [x] Will open registration for Departmental admins (will use an authorization key for registration, it'll be a Hash). This key will be generated automatically, admin will have a separate interface to generate the key (dynamic creation of it).
- [x] If the tokens are already generated then admin can view both the tokens.
- [x] Remove the temporary display of email contents and uncoment the mail() function.
- [x] If session already set, then login directly on register and login pages.
- [x] Redirect to login page after successful registration.
- [ ] Admin can delete any user (Student/Department)
- [x] Add request handlers for fake students registrations/resetting of account (can use registration no. of JEE Mains, feedback verification password).

### **Department Interface**
- [x] 2 Admins (Super Admin (H.O.D.) and Elective poster (Professor)).
- [ ] Department admin gets the final list of students selected for each elective.
- [x] Elective poster have the ability to post multiple electives.
- [x] Elective posting confirmation will go to Admin once approved by Super Admin.
- [x] Elective when approved by Super Admin and published, will be open for registrations.
- [x] Add UG/PG Elective, subject codes will be chosen from dropdown.
- [x] Add option for no. of seats available for the elective.
- [x] Can view the list of students selected and the students who've applied for the elective.
- [x] When posting elective will post the following details - No. of seats, Elective code (as multiple electives), Name of professor taking the course, Any additional information, Auto close registration/not.
- [x] Have the option to update elective details after posting (Keep in mind about auto close registration case).
- [x] Timestamp will be added on every registration request,rejection, publishing elective, super admin confirmation, updating, etc.
- [x] Department name, elective names, etc. will be available from CC.

### **Student Interface**
- [ ] Mail sending on successful allotment of seat, rejection.
- [x] Login will be with the help of roll no.
- [x] After logging in student will prioritize electives (Priority once set can't be updated - show prompt).
- [x] After the student applies show his/her status in each elective (update dynamically).
- [x] Timestamp while setting priorities will also be set.
- [x] Allow students to change and recover passwords.
