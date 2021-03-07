mod encrypt;
mod decrypt;

use md5;

fn main() {
    println!("Enter Password: ");
    
    let mut password = String::new();
    
    std::io::stdin()
        .read_line(&mut password)
        .expect(&format!("Failed to read password from STDIN."))
    ;

    password = String::from(password.trim());

    println!("");
    println!("Password: {}", password);
    
    let hash = md5::compute(password);
    
    println!("Password MD5: {:?}", hash);
    
    
}
