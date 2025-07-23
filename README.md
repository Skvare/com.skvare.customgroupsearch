# Restrict Custom Group in Advanced Search Using User Roles

![Screenshot](/images/custom_group_role_restriction.png)

This CiviCRM extension allows administrators to restrict which Custom Groups are displayed in the Advanced Search interface based on user roles. It provides role-based access control for Custom Groups, ensuring that sensitive custom fields are only visible to users with appropriate permissions.

When creating or editing a Custom Group, administrators can specify which user roles should have access to see and use that Custom Group in Advanced Search. Users without the specified roles will not see these Custom Groups as search options.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v7.2+
* CiviCRM 5.0+
* Supported CMS: Drupal 7, Drupal 8+, Backdrop

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl com.skvare.customgroupsearch@https://github.com/skvare/com.skvare.customgroupsearch/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/skvare/com.skvare.customgroupsearch.git
cv en customgroupsearch
```

## Usage

After installing and enabling the extension:

1. **Configure Custom Groups**: Navigate to **Administer > Customize Data and Screens > Custom Fields > Custom Data Groups**
2. **Edit Custom Group**: When creating or editing a Custom Group, you'll see a new field "Show Custom Group in Search for only these roles"
3. **Select Roles**: Choose which user roles should have access to see this Custom Group in Advanced Search
4. **Save**: The Custom Group will now only appear in Advanced Search for users with the selected roles

## Features

* **Role-based Access Control**: Restrict Custom Group visibility in Advanced Search based on user roles
* **Multi-CMS Support**: Works with Drupal 7, Drupal 8+, Backdrop
* **Easy Configuration**: Simple dropdown selection during Custom Group creation/editing
* **Seamless Integration**: Integrates directly into CiviCRM's existing Custom Group management interface

## How It Works

The extension hooks into CiviCRM's form building and processing to:
1. Add a role selection field to the Custom Group form
2. Store role restrictions in CiviCRM settings
3. Filter Custom Groups in Advanced Search based on the current user's roles
4. Only display Custom Groups that the user has permission to access


## Support and Contributing

- **Issues:** Report bugs and feature requests on [GitHub Issues](https://github.com/Skvare/com.skvare.customgroupsearch/issues)

## Credits

Developed by [Skvare, LLC](https://skvare.com/contact) for the CiviCRM community.

## About Skvare

Skvare LLC specializes in CiviCRM development, Drupal integration, and providing technology solutions for nonprofit organizations, professional societies, membership-driven associations, and small businesses. We are committed to developing open source software that empowers our clients and the wider CiviCRM community.

**Contact Information**:
- Website: [https://skvare.com](https://skvare.com)
- Email: info@skvare.com
- GitHub: [https://github.com/Skvare](https://github.com/Skvare)

## Support

[Contact us](https://skvare.com/contact) for support or to learn more.

---

## Related Extensions

You might also be interested in other Skvare CiviCRM extensions:

- **Database Custom Field Check**: Prevents adding custom fields when table limits are reached
- **Image Resize**: Automatically resizes contact images for consistent display
- **Registration Button Label**: Customize button labels on event registration pages
- **Unlink User Account**: Safely unlink user accounts from contacts without deleting data

For a complete list of our open source contributions, visit our [GitHub organization page](https://github.com/Skvare).

