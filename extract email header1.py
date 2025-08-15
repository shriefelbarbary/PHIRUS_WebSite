from email import message_from_file
from email.utils import parsedate_to_datetime

def extract_email_headers_from_file(file_path):
    try:
        # Open the email file and parse the headers
        with open(file_path, 'r') as email_file:
            msg = message_from_file(email_file)

        # Extract key header details
        from_ = msg.get("From", "N/A")
        to = msg.get("To", "N/A")
        subject = msg.get("Subject", "N/A")
        date = msg.get("Date", "N/A")
        message_id = msg.get("Message-ID", "N/A")
        reply_to = msg.get("Reply-To", "N/A")

        # Convert date to a more readable format if possible
        if date != "N/A":
            try:
                date = parsedate_to_datetime(date).isoformat()
            except:
                pass  # Keep the original format if parsing fails

        # Display extracted header information
        print("----- Extracted Email Header Information -----")
        print(f"From: {from_}")
        print(f"To: {to}")
        print(f"Subject: {subject}")
        print(f"Date: {date}")
        print(f"Message-ID: {message_id}")
        print(f"Reply-To: {reply_to}")

    except Exception as e:
        print(f"Error reading or parsing the email file: {e}")

# Example usage
if __name__ == "__main__":
    email_file_path = input("Enter the path to the email file (.eml): ").strip()
    
    if email_file_path:
        extract_email_headers_from_file(email_file_path)
    else:
        print("Error: The file path cannot be empty.")


