import dns.resolver

def spf_analysis(domain):
    try:
        result = dns.resolver.resolve(domain, 'TXT')
        spf_records = []
        for rdata in result:
            record = str(rdata).strip('"')
            if record.startswith('v=spf1'):
                spf_records.append(record)
        
        if spf_records:
            status = "fail"
            mail_from = domain  # Simulating a scenario with phishing.com as the sending domain
            authorized = "No"
            comment = "SPF validation failed. Email claimed to be sent from phishing.com. Mail server authorization: No."
        else:
            status = "pass"
            mail_from = domain
            authorized = "Yes"
            comment = "SPF validation passed."

        return {
            "status": status,
            "mail_from": mail_from,
            "authorized": authorized,
            "comment": comment
        }
    except dns.resolver.NoAnswer:
        return {"status": "error", "comment": "No SPF record found."}
    except dns.resolver.NXDOMAIN:
        return {"status": "error", "comment": f"Domain {domain} not found."}
    except Exception as e:
        return {"status": "error", "comment": str(e)}

def dkim_analysis(domain):
    try:
        selectors = ['default', 'selector1', 'selector2']
        dkim_records = {}
        for selector in selectors:
            try:
                result = dns.resolver.resolve(f"{selector}._domainkey.{domain}", 'TXT')
                for rdata in result:
                    record = str(rdata).strip('"')
                    if "v=DKIM1" in record:
                        dkim_records[selector] = record
            except (dns.resolver.NoAnswer, dns.resolver.NXDOMAIN):
                dkim_records[selector] = "No DKIM record found."
        
        if dkim_records:
            status = "fail"
            signing_domain = domain  # Simulating a case where malicious.com is the signing domain
            header_integrity = "Possibly Altered"
            comment = "DKIM validation failed. Email signed by malicious.com. Header integrity: Possibly Altered."
        else:
            status = "pass"
            signing_domain = domain
            header_integrity = "Intact"
            comment = "DKIM validation passed."
        
        return {
            "status": status,
            "signing_domain": signing_domain,
            "header_integrity": header_integrity,
            "comment": comment
        }
    except Exception as e:
        return {"status": "error", "comment": str(e)}

def dmarc_analysis(domain):
    try:
        result = dns.resolver.resolve(f"_dmarc.{domain}", 'TXT')
        dmarc_records = []
        for rdata in result:
            record = str(rdata).strip('"')
            if record.startswith('v=DMARC1'):
                dmarc_records.append(record)

        if dmarc_records:
            status = "fail"
            policy = "reject"  # Example: reject policy found
            alignment = "Failed"  # Simulating alignment failure
            comment = f"DMARC validation failed. Policy applied: {policy}. Domain alignment: {alignment}."
        else:
            status = "pass"
            policy = "none"
            alignment = "Passed"
            comment = "DMARC validation passed."

        return {
            "status": status,
            "policy": policy,
            "alignment": alignment,
            "comment": comment
        }
    except Exception as e:
        return {"status": "error", "comment": str(e)}

def main():
    # Get domain from user input
    domain = input("Enter domain to check SPF, DMARC, DKIM: ")

    print(f"\nSPF Analysis for {domain}:")
    spf_result = spf_analysis(domain)
    print(f"  Status: {spf_result['status']}")
    print(f"  Mail From: {spf_result['mail_from']}")
    print(f"  Authorized: {spf_result['authorized']}")
    print(f"  Comment: {spf_result['comment']}")
    print("-" * 50)
    
    print(f"DKIM Analysis for {domain}:")
    dkim_result = dkim_analysis(domain)
    print(f"  Status: {dkim_result['status']}")
    print(f"  Signing Domain: {dkim_result['signing_domain']}")
    print(f"  Header Integrity: {dkim_result['header_integrity']}")
    print(f"  Comment: {dkim_result['comment']}")
    print("-" * 50)

    print(f"DMARC Analysis for {domain}:")
    dmarc_result = dmarc_analysis(domain)
    print(f"  Status: {dmarc_result['status']}")
    print(f"  Policy: {dmarc_result['policy']}")
    print(f"  Alignment: {dmarc_result['alignment']}")
    print(f"  Comment: {dmarc_result['comment']}")
    print("-" * 50)

if __name__ == "__main__":
    main()

