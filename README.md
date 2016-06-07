# SAIMemo01

Next build of SAIMemo00 with more attractive features. </br>

</br>
Project code => Project SAI </br>
Code name => The GATES </br>
Actual type => Cloud storage

---

### General Info

Programming specs:
  - PHP Framework: Codeigniter
  - Bootstrap
  - jQuery

Architecture:
  - MVC

No built in Library:
  - Password

Additional plug-in:
  - animate
  - font-awesome

---

### Improved features

**User authentication**

_Login_
  - Forgot password
  - Special token for accessing reset password 
      - Determined token validity's time
      - Sent to email
      
_Register_
  - Two stage registration
      - *First stage*
          - First & Last Name 
          - Email
          - Special token for completing the registration
              - Determined token validity's time
              - Sent to email
          - User's status for this stage: *pending*
      - *Second stage*
          - Password
              - Only valid token can accessed this stage
          - User's status for this stage: *approved*
          
**Superadmin & Admin**

_Superadmin_
  - Albertus Kelvin
  - Capabilities:
      - Choose Admin
      - Add and remove users
      - Edit users' profile => username and password
      - See users' activity
      - Modify location which is used for storing users' files
      - Promote all users to become an Admin
      - Demote all users from becoming an Admin
      - Edit Superadmin's profile

_Admin_
  - Determined by Superadmin
  - Capabilities:
      - Add and remove users, except Superadmin
      - Edit users' profile, except Superadmin => username and password
      - See user's activity
      - Modify location which is used for storing users' files
      - Promote all users to become an Admin, except Superadmin
      - Demote all users from becoming an Admin, except Superadmin
      - Edit Admin's profile

**User**

_Status: pending_
  - User can't access the memo till he/she use the valid token for creating a new password

_Status: approved_
  - User can access the memo
  - If no promotion given, his/her role in accessing the memo is *subscriber*
  - If any promotion given, his/her role in accessing the memo is *admin*
  - Capabilities:
      - Modify username and password
      - Create a new folder => can also be many folders in a folder, and so on...
      - Upload new files => any extensions
      - Download a file 
      - Delete a file
      - Sort the list of files according to 'Name', 'Modified time', and 'Size'

**Session**

This version of SAIMemo uses session to integrate the experience's flow among authentication, memo, and SAIMemo's home

**Log activity**

  - Can only be accessed by Superadmin and Admin
  - Show the history of activities of SAIMemo
      - New login and registration
      - Modifying profile
      - Folder creation
      - Files' upload, download, and delete
  - Can be sorted

---

### Next development

Storing location:
  - Current: local
  - Future: real server

---

**Albertus Kelvin** </br>
**Institut Teknologi Bandung** </br>
**Bandung, Indonesia**

