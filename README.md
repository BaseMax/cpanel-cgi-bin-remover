# cPanel cgi-bin Remover

A simple PHP script to recursively scan and delete all `cgi-bin` directories within your web root. This tool is useful for cleaning up unwanted or malicious `cgi-bin` directories that may be lingering on your server.

## Features

- Recursively searches through your document root
- Deletes all directories named `cgi-bin` and their contents
- Safe and straightforward implementation
- Suitable for server cleanup and security hardening

## Usage

- Download the `delete_cgi_bins.php` script from this repository.
- Upload the script to your server (preferably outside of your public web directory for safety).
- Access the script via your web browser or run it via CLI if PHP is available on your server.
- The script will automatically scan your web root and delete all `cgi-bin` directories found.

> Note: Make sure to back up your data before running this script.
Run with caution, as this will permanently delete directories named `cgi-bin` and their contents.

## Disclaimer

Use this script at your own risk. Ensure you have appropriate permissions and backups before executing deletion scripts on your server.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Author

Max Base (c) 2025
