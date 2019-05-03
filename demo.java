

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.ie.InternetExplorerDriver;
import org.openqa.selenium.support.ui.ExpectedCondition;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.sql.*;
public class demo {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		System.setProperty("webdriver.chrome.driver","C:\\Users\\pcroot\\Desktop\\chromedriver_win32\\chromedriver.exe" );
		
//		edituser();
		deleteUser();
		
		


		
		
		
	}
	
	void addDoctor() {
		
		WebDriver driver = new ChromeDriver();
		{
		driver.get("http://localhost/ehealth");
		
		driver.findElement(By.name("username")).sendKeys("username3");
		driver.findElement(By.name("password")).sendKeys("3");
		driver.findElement(By.className("btn-primary")).click();
		
		driver.get("http://localhost/ehealth/AddDoctor.php");// add doctor test case//
		
		driver.findElement(By.id("Name")).sendKeys("khaled");
		driver.findElement(By.id("Surname")).sendKeys("amairi");
		driver.findElement(By.id("Username")).sendKeys("tester");
		driver.findElement(By.id("Password")).sendKeys("Tester123");
		driver.findElement(By.id("BirthDate")).sendKeys("02/05/2019");
		driver.findElement(By.id("Specialization")).sendKeys("testing");
		driver.findElement(By.id("button1")).click();
		
		
		String SELECT_QUERY = "SELECT * FROM doctor where Name = 'khaled'";
		String host = "jdbc:mysql://localhost:3306/ehealth";
        String uName = "root";
        String uPass= "";
        
        try (Connection conn = DriverManager.getConnection(host, uName, uPass);
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

               while (rs.next()) {
                   //read your lines one ofter one
                   int id = rs.getInt("DoctorID");
                   String username = rs.getString("Name");
                   String surname = rs.getString("Surname");
                   String bd = rs.getString("BirthDate");
                   int userid= rs.getInt("UserID");
                   String spec=rs.getString("Specialization");
                   System.out.println(username);
                   System.out.println(id);
                   System.out.println(userid);
                   System.out.println(bd);
                   System.out.println(surname);
                   System.out.println(spec);
                   // etc. 
               }
               
                  
               
               
               
               
               
           } catch (SQLException e) {
               e.printStackTrace();
           }
		}
		
		driver.close();
	}
	void addPatient() {
		
		WebDriver driver = new ChromeDriver();
		 
		 
		 driver.get("http://localhost/ehealth");
			
			driver.findElement(By.name("username")).sendKeys("username3");
			driver.findElement(By.name("password")).sendKeys("3");
			driver.findElement(By.className("btn-primary")).click();
			
			driver.get("http://localhost/ehealth/AddPatient.php");// add patient test case//
			
			driver.findElement(By.id("Name")).sendKeys("enver");
			driver.findElement(By.id("Surname")).sendKeys("ever");
			driver.findElement(By.id("Username")).sendKeys("teacher1");
			driver.findElement(By.id("Password")).sendKeys("Tester123");
			driver.findElement(By.id("BirthDate")).sendKeys("02/05/2019");
			driver.findElement(By.id("DoctorID")).sendKeys("5");
			driver.findElement(By.id("button1")).click();
			
			
			String SELECT_QUERY = "SELECT * FROM patient where Name = 'enver'";
			String host = "jdbc:mysql://localhost:3306/ehealth";
	        String uName = "root";
	        String uPass= "";
	        
	        try (Connection conn = DriverManager.getConnection(host, uName, uPass);
	                Statement stmt = conn.createStatement();
	                ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

	               while (rs.next()) {
	                   //read your lines one ofter one
	            	   int id = rs.getInt("PatientID");
	                   String username = rs.getString("Name");
	                   String surname = rs.getString("Surname");
	                   String bd = rs.getString("BirthDate");
	                   int userid= rs.getInt("UserID");
	                   System.out.println(username);
	                   System.out.println(id);
	                   System.out.println(userid);
	                   System.out.println(bd);
	                   System.out.println(surname);
	                   // etc. 
	               }
	               
	                  
	               
	               
	               
	               
	               
	           } catch (SQLException e) {
	               e.printStackTrace();
	           }
	        driver.close();
	}
	static void login() {
		
		
		
		WebDriver driver = new ChromeDriver();
		
		driver.get("http://localhost/ehealth");
		
		driver.findElement(By.name("username")).sendKeys("username3");
		driver.findElement(By.name("password")).sendKeys("3");
		driver.findElement(By.className("btn-primary")).click();
		
		
		
		if(driver.getTitle().equalsIgnoreCase("e-health System")) {
			
			System.out.println("login is successfully");
		}
	
	}
	static void viewpatients() {
		WebDriver driver = new ChromeDriver();
			driver.get("http://localhost/ehealth");
		
		driver.findElement(By.name("username")).sendKeys("username5");
		driver.findElement(By.name("password")).sendKeys("5");
		driver.findElement(By.className("btn-primary")).click();
		
		driver.findElement(By.linkText("Patients Table")).click();
		if(driver.getTitle().equalsIgnoreCase("patient table")) {
			
			System.out.println("viewpatients successfully");
		}
		
	}
	static void edituser() {
		WebDriver driver = new ChromeDriver();
		driver.get("http://localhost/ehealth");
	
	driver.findElement(By.name("username")).sendKeys("username3");
	driver.findElement(By.name("password")).sendKeys("3");
	driver.findElement(By.className("btn-primary")).click();
	
	driver.get("http://localhost/ehealth/DoctorTable.php");
	
	driver.findElement(By.linkText("Edit")).click();
	driver.findElement(By.id("Name")).clear();
	driver.findElement(By.id("Name")).sendKeys("kokko");
	driver.findElement(By.id("Surname")).clear();
	driver.findElement(By.id("Surname")).sendKeys("kolal");
	driver.findElement(By.id("Username")).clear();
	driver.findElement(By.id("Username")).sendKeys("tester");
	driver.findElement(By.id("Password")).clear();
	driver.findElement(By.id("Password")).sendKeys("Tester123");
	driver.findElement(By.id("BirthDate")).clear();
	driver.findElement(By.id("BirthDate")).sendKeys("02/05/2019");
	driver.findElement(By.id("Specialization")).clear();
	driver.findElement(By.id("Specialization")).sendKeys("testing");
	driver.findElement(By.id("button1")).click();
	String SELECT_QUERY = "SELECT * FROM doctor where Name = 'kokko'";
	String host = "jdbc:mysql://localhost:3306/ehealth";
    String uName = "root";
    String uPass= "";
    
    try (Connection conn = DriverManager.getConnection(host, uName, uPass);
            Statement stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

           while (rs.next()) {
               //read your lines one ofter one
               int id = rs.getInt("DoctorID");
               String username = rs.getString("Name");
               String surname = rs.getString("Surname");
               String bd = rs.getString("BirthDate");
               int userid= rs.getInt("UserID");
               String spec=rs.getString("Specialization");
               System.out.println(username);
               System.out.println(id);
               System.out.println(userid);
               System.out.println(bd);
               System.out.println(surname);
               System.out.println(spec);
               // etc. 
           }
           
              
           
           
           
           
           
       } catch (SQLException e) {
           e.printStackTrace();
       }
	
	
		
	}

	static void deleteUser() {
		String SELECT_QUERY = "SELECT * FROM doctor where Name = 'kokko'";
		String host = "jdbc:mysql://localhost:3306/ehealth";
	    String uName = "root";
	    String uPass= "";
	    
	    try (Connection conn = DriverManager.getConnection(host, uName, uPass);
	            Statement stmt = conn.createStatement();
	            ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

	           while (rs.next()) {
	               //read your lines one ofter one
	               int id = rs.getInt("DoctorID");
	               String username = rs.getString("Name");
	               String surname = rs.getString("Surname");
	               String bd = rs.getString("BirthDate");
	               int userid= rs.getInt("UserID");
	               String spec=rs.getString("Specialization");
	               System.out.println(username);
	               System.out.println(id);
	               System.out.println(userid);
	               System.out.println(bd);
	               System.out.println(surname);
	               System.out.println(spec);
	               // etc. 
	           }
	           
	    } catch (SQLException e) {
            e.printStackTrace();
        }
	    
	    WebDriver driver = new ChromeDriver();
		driver.get("http://localhost/ehealth");
	
	driver.findElement(By.name("username")).sendKeys("username3");
	driver.findElement(By.name("password")).sendKeys("3");
	driver.findElement(By.className("btn-primary")).click();
	
	driver.get("http://localhost/ehealth/DoctorTable.php");
	
	driver.findElement(By.cssSelector("#doctorRow > tr:nth-child(1) > td:nth-child(8) > button")).click();
	
	try (Connection conn = DriverManager.getConnection(host, uName, uPass);
            Statement stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

           while (rs.next()) {
               //read your lines one ofter one
               int id = rs.getInt("DoctorID");
               String username = rs.getString("Name");
               String surname = rs.getString("Surname");
               String bd = rs.getString("BirthDate");
               int userid= rs.getInt("UserID");
               String spec=rs.getString("Specialization");
               System.out.println(username);
               System.out.println(id);
               System.out.println(userid);
               System.out.println(bd);
               System.out.println(surname);
               System.out.println(spec);
               // etc. 
           }
           
    } catch (SQLException e) {
        e.printStackTrace();
    }
		
	}



}
