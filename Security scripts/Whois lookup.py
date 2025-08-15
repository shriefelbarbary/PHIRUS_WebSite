import whois

def whois_lookup(domain):
    try:
        # Perform WHOIS lookup
        domain_info = whois.whois(domain)
        
        # Display relevant information
        print(f"Domain Name: {domain_info.domain_name}")
        print(f"Registrar: {domain_info.registrar}")
        print(f"Creation Date: {domain_info.creation_date}")
        print(f"Expiration Date: {domain_info.expiration_date}")
        print(f"Updated Date: {domain_info.updated_date}")
        print(f"Name Servers: {domain_info.name_servers}")
        print(f"Status: {domain_info.status}")
        print(f"Owner:{ domain_info.org}")
    except Exception as e:
        print(f"Error: {e}")

# Get domain input from user
domain = input("Enter the domain you want to look up: ")
whois_lookup(domain)