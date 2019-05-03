package database_testing;
import java.sql.*;

 

public class db {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		String SELECT_QUERY = "SELECT * FROM user";
		String host = "jdbc:mysql://localhost:3306/ehealth";
        String uName = "root";
        String uPass= "";
        
        try (Connection conn = DriverManager.getConnection(host, uName, uPass);
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

               while (rs.next()) {
                   //read your lines one ofter one
                   int id = rs.getInt("UserID");
                   String username = rs.getString("Username");
                   
                   System.out.println(username);
                   System.out.println(id);
                   // etc. 
               }
               
                  
               
               
               
               
               
           } catch (SQLException e) {
               e.printStackTrace();
           }
        
        System.out.println("================================================");
        SELECT_QUERY = "SELECT * FROM patient";
        
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
        System.out.println("================================================");   
        
        SELECT_QUERY = "SELECT * FROM ehealth.chat_message";
        
        try (Connection conn = DriverManager.getConnection(host, uName, uPass);
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

               while (rs.next()) {
                   //read your lines one ofter one
                   int id = rs.getInt("chat_message_id");
                   String time = rs.getString("timestamp");
                   String ms = rs.getString("chat_message");
                   int userid1= rs.getInt("from_user_id");
                   int userid= rs.getInt("to_user_id");
                   System.out.println(time);
                   System.out.println(id);
                   System.out.println(userid);
                   System.out.println(userid1);
                   System.out.println(ms);
                   // etc. 
               }
                 
               
           } catch (SQLException e) {
               e.printStackTrace();
           }
        
        
  System.out.println("================================================");   
        
        SELECT_QUERY = "SELECT * FROM ehealth.doctor";
        
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
        
 System.out.println("================================================");   
        
        SELECT_QUERY = "SELECT * FROM ehealth.doctorpatient";
        
        try (Connection conn = DriverManager.getConnection(host, uName, uPass);
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

               while (rs.next()) {
                   //read your lines one ofter one
                    int id = rs.getInt("DoctorID");
                  
                   int userid= rs.getInt("PatientID");
                   int idp=rs.getInt("DoctorPatientID");
                  
                   System.out.println(idp);
                   System.out.println(userid);
                   System.out.println(id);
                  
                  
                   // etc. 
               }
                 
               
           } catch (SQLException e) {
               e.printStackTrace();
           }
        
        
 System.out.println("================================================");   
        
        SELECT_QUERY = "SELECT * FROM ehealth.sensorreading;";
        
        try (Connection conn = DriverManager.getConnection(host, uName, uPass);
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

               while (rs.next()) {
                   //read your lines one ofter one
                    int id = rs.getInt("SensorReadingID");
                  
                   int userid= rs.getInt("PatientID");
                   double hr=rs.getDouble("HeartRate");
                   double idp=rs.getDouble("Temperature");
                   double spo2=rs.getDouble("SPO2");
                   System.out.println(spo2);
                   System.out.println(hr);
                   System.out.println(idp);
                   System.out.println(userid);
                   System.out.println(id);
                  
                   System.out.println("================================================");   
                   // etc. 
               }
                 
               
           } catch (SQLException e) {
               e.printStackTrace();
           }
        
 System.out.println("================================================");   
        
        SELECT_QUERY = "SELECT * FROM ehealth.sensorreading;";
        
        try (Connection conn = DriverManager.getConnection(host, uName, uPass);
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(SELECT_QUERY)) {

               while (rs.next()) {
                   //read your lines one ofter one
                    int id = rs.getInt("SensorReadingID");
                  
                   int userid= rs.getInt("PatientID");
                   double hr=rs.getDouble("HeartRate");
                   double idp=rs.getDouble("Temperature");
                   double spo2=rs.getDouble("SPO2");
                   System.out.println(spo2);
                   System.out.println(hr);
                   System.out.println(idp);
                   System.out.println(userid);
                   System.out.println(id);
                  
                   System.out.println("================================================");   
                   // etc. 
               }
                 
               
           } catch (SQLException e) {
               e.printStackTrace();
           }
        
                
        
        try {
            //STEP 2: Register JDBC driver
            Class.forName("com.mysql.jdbc.Driver");

            //STEP 3: Open a connection
            System.out.println("Connecting to a selected database...");
            Connection conn = DriverManager.getConnection(host, uName, uPass);
            System.out.println("Connected database successfully...");
            
            //STEP 4: Execute a query
            System.out.println("Inserting records into the table...");
            Statement stmt = conn.createStatement();
            
            String sql = "INSERT INTO patient " +
                         "VALUES (1111, 11, 'patienttest', 'patienttest2','1955-05-05')";
            stmt.executeUpdate(sql);
            
             sql = "INSERT INTO admin " +
                    "VALUES (2222, 22, 'admintest', 'admintest2','1955-05-05')";
             stmt.executeUpdate(sql);
             sql = "INSERT INTO doctor " +
                     "VALUES (3333, 33, 'doctortest', 'doctortest2','1955-05-05','heartrate')";
              stmt.executeUpdate(sql);
              
              sql = "INSERT INTO sensorreading " +
                      "VALUES (10, 2, 22.2, 22.2,3.5,'2018-05-01 14:14:14')";
               stmt.executeUpdate(sql);
               
               sql = "INSERT INTO user " +
                       "VALUES (23, 'testuser','testpassword' , 'Admin')";
                stmt.executeUpdate(sql);

            System.out.println("Inserted records into the table...");

         }catch(SQLException se){
            //Handle errors for JDBC
            se.printStackTrace();
         }catch(Exception e){
            //Handle errors for Class.forName
            e.printStackTrace();
         }finally{
            //finally block used to close resources
            
            
         }//end try
       }
	

}
