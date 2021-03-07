/// Rust implementation of the PHP encrypt script.
/// 
/// Made mainly for understaing the encryption process
/// and help with developing the decryption.

fn sum_hex_string(hex: &String) -> u16  {
    let mut total: u16 = 0;
    let characters = hex.split("");

    for character in characters {
        if character != "" {
            total += u16::from_str_radix(character, 16).unwrap();
        }
    }

    total
}
