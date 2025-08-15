import requests

def check_domain_virustotal(api_key, domain):
    url = f"https://www.virustotal.com/api/v3/domains/{domain}"
    headers = {
        "x-apikey": api_key
    }

    try:
        # Send request to VirusTotal API
        response = requests.get(url, headers=headers)
        
        if response.status_code == 200:
            data = response.json()
            
            # Check the domain's reputation
            malicious_votes = data.get("data", {}).get("attributes", {}).get("last_analysis_stats", {}).get("malicious", 0)
            suspicious_votes = data.get("data", {}).get("attributes", {}).get("last_analysis_stats", {}).get("suspicious", 0)
            
            print(f"Domain: {domain}")
            print(f"Malicious Votes: {malicious_votes}")
            print(f"Suspicious Votes: {suspicious_votes}")
            
            if malicious_votes > 0 or suspicious_votes > 0:
                print(f"ALERT: The domain '{domain}' is flagged as potentially malicious or suspicious.")
            else:
                print(f"The domain '{domain}' appears safe.")
        else:
            print(f"Error: Unable to query VirusTotal (Status Code: {response.status_code})")
    except Exception as e:
        print(f"An error occurred: {e}")

# Example usage
api_key = "7019e4123a3e38c9ed8f8afd087ace44d8a02cb686b5f0227d60b59d8cc8a3eb"  # Replace with your API key
domain = input("Enter the domain to check (e.g., example.com): ")  # Replace with the domain you want to check
check_domain_virustotal(api_key, domain)
