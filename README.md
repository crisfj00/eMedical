# eMedical

Medical prescription page

1. Log in Registration page for users with Laravel controllers. 
   Doctors will be manually part of the system as we think it like a hospital network that doctors are already authenticated users.

2. Role system based on Laravel middleware:
   Doctors post the prescriptions, and the user reads and downloads them.
   User can create make consultation to doctors
   Doctor can answer by creating a prescription

3. Access control:
   Doctors can create, read, update, and delete a prescription
   User will only see the prescription that belongs to her
   Users can post consultations to doctors
        
In total we will create 3 pages:
    1. Login/sign up,
    2. Page of prescriptions,
    3. Page of consultations.

Security Features
    1. Authentication features: with an email verification during the registration of the users.
    2. Passwords protection in the DB by hashing it. 
    3. Preventing SQL injection by protecting DB queries: parameter validation.
