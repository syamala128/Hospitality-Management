import org.w3c.dom.*;
import javax.xml.parsers.*;
import java.io.File;
import java.util.Scanner;

public class UserDetails {

    public static void main(String[] args) {
        try {
            // Load the XML file
            File inputFile = new File("users.xml");
            DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
            Document doc = dBuilder.parse(inputFile);
            doc.getDocumentElement().normalize();

            // Get the user ID from input
            Scanner scanner = new Scanner(System.in);
            System.out.print("Enter User ID: ");
            String userId = scanner.nextLine();

            // Get the list of users
            NodeList nList = doc.getElementsByTagName("user");

            // Iterate through the users to find the matching user ID
            for (int temp = 0; temp < nList.getLength(); temp++) {
                Node nNode = nList.item(temp);

                if (nNode.getNodeType() == Node.ELEMENT_NODE) {
                    Element eElement = (Element) nNode;
                    String id = eElement.getElementsByTagName("id").item(0).getTextContent();

                    if (id.equals(userId)) {
                        String name = eElement.getElementsByTagName("name").item(0).getTextContent();
                        String email = eElement.getElementsByTagName("email").item(0).getTextContent();
                        String age = eElement.getElementsByTagName("age").item(0).getTextContent();

                        System.out.println("User Details:");
                        System.out.println("ID: " + id);
                        System.out.println("Name: " + name);
                        System.out.println("Email: " + email);
                        System.out.println("Age: " + age);
                        return;
                    }
                }
            }

            System.out.println("User not found.");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}