Before import user follow the below steps:
- Check whether the `assets` directory present in your site/project root directory or not.
- If present then, provide this directory to write permission.
- If not present then, create the same and provide this directory to write permission.

Important Note for Multivalued data:
- Say you have a field "Looking For" and this field is multivalued field(checkbox or select)
- Your options are Man, Woman, Both, Other
- Now for a user want to import Woman then in CSV file under "Looking For" column you have to write "Woman::"
- If for a user want to import Woman and Man then in CSV file under "Looking For" column you have to write "Woman::Man"
- If for a user want to import Woman, Man and both then in CSV file under "Looking For" column you have to write "Woman::Man::Both"

Multivalued field for exiting users:
If you are going to update an existing user data but don't want to update that user's a data which is multivalued field 
then you have to remove that field from the CSV file.

Change Log:
== 3.7 ==
- Used WP function to check file type.
- Added support for Membership plug-in. Now subscription can also be mapped through CSV file to a member.
- Added new section to show WP, BP and Membership plug-in fields that needs to be add in CSV file.
- Did some text changes.
- Did the fixes that css file were not loading.
- Added nonce security field.
- Handled blank rows.
== 3.6 ==
- If image/avatar url has space then getting fatal error. Fixed.
- If any image/avatar url is 404 then fatal error coming and stop working. Handled.