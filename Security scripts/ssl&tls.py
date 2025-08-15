import socket
import ssl
from urllib.parse import urlparse

def get_ssl_certificate_details(url):
    try:
        # Parse the URL to extract hostname
        parsed_url = urlparse(url)
        hostname = parsed_url.netloc if parsed_url.netloc else parsed_url.path

        # Connect to the server and retrieve the certificate
        context = ssl.create_default_context()
        with socket.create_connection((hostname, 443)) as sock:
            with context.wrap_socket(sock, server_hostname=hostname) as ssock:
                cert = ssock.getpeercert()

        # Extract relevant details
        subject = dict(x[0] for x in cert['subject'])
        issued_to = subject.get('commonName', 'Unknown')
        issuer = dict(x[0] for x in cert['issuer']).get('commonName', 'Unknown')
        valid_from = cert.get('notBefore', 'Unknown')
        valid_to = cert.get('notAfter', 'Unknown')

        return {
            'Issued To': issued_to,
            'Issuer': issuer,
            'Valid From': valid_from,
            'Valid To': valid_to,
        }
    except Exception as e:
        return f"Error: Unable to retrieve SSL/TLS certificate details - {str(e)}"


if __name__ == "__main__":
    # Prompt user for input URL
    url = input("Enter the URL (e.g., https://example.com): ").strip()
    if not url.startswith("https://"):
        url = "https://" + url  # Ensure it's HTTPS for SSL

    cert_details = get_ssl_certificate_details(url)
    if isinstance(cert_details, dict):
        print("\nSSL/TLS Certificate Details:")
        for key, value in cert_details.items():
            print(f"{key}: {value}")
    else:
        print(cert_details)
