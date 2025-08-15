from PIL import Image

def check_and_extract_message_from_image():
    """Prompts user for an image path, checks if there is a hidden message, and extracts it."""
    image_path = input("Enter the path to the image file: ")
    
    try:
        image = Image.open(image_path)
    except Exception as e:
        print(f"Error opening image: {e}")
        return None

    width, height = image.size
    bits = ""

    for y in range(height):
        for x in range(width):
            r, g, b = image.getpixel((x, y))
            bits += str(r & 1)  # Extract LSB from the red channel

    # Search for the end signal in the bits
    end_signal = '11111110'
    if end_signal not in bits:
        print("No hidden message found in the image.")
        return None

    # Decode the message
    message = ""
    for i in range(0, len(bits), 8):
        byte = bits[i:i+8]
        if byte == end_signal:  # Stop if end signal is found
            break
        message += chr(int(byte, 2))

    print("Hidden message found in the image:", message)
    return message

# Example usage
check_and_extract_message_from_image()
