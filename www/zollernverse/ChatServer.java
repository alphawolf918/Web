import java.io.*;
import java.net.*;
import java.util.*;
import java.applet.Applet;

public class ChatServer {
	ArrayList<Object> clientOutputStreams;
	String fullMessage = "";
	
	public static void main(String[] args){
		ChatServer cs = new ChatServer();
		cs.go();
	}
        public static String GetLine(){
            String inputLine = null;
            BufferedReader is = new BufferedReader(new InputStreamReader(System.in));
            try {
                inputLine = is.readLine();
            } catch (IOException ex) {
            }
            return inputLine;
        }
	public class ClientHandler implements Runnable, Serializable {
		BufferedReader reader;
		Socket sock;
		public ClientHandler(Socket clientSocket){
			try {
				sock = clientSocket;
				InputStreamReader isReader = new InputStreamReader(sock.getInputStream());
				reader = new BufferedReader(isReader);
			} catch(Exception ex){
				ex.printStackTrace();
			}
		}
		public void run(){
			String message;
			try {
				while((message = reader.readLine()) != null){
					String txt = message;
					fullMessage+=txt;
					fullMessage+="\n";
					BufferedWriter writer = new BufferedWriter(new FileWriter("chatLog.txt"));
					if(fullMessage != null){
						writer.write(fullMessage);
					}
					writer.close();
					tellEveryone(txt);
					System.out.println("Read: "+message);
				}
			} catch(Exception ex){
				ex.printStackTrace();
			}
		}
	}
	public void attemptConnect(int intPort) throws IOException {
				ServerSocket serverSock = new ServerSocket(intPort);
				while(true){
					Socket clientSocket = serverSock.accept();
					PrintWriter writer  = new PrintWriter(clientSocket.getOutputStream());
					clientOutputStreams.add(writer);
					Thread t = new Thread(new ClientHandler(clientSocket));
					t.start();
					System.out.println("Connected!");
				}
	}
	public void go(){
		clientOutputStreams = new ArrayList<Object>();
		try {
			attemptConnect(5000);
		} catch(BindException ex){
			System.out.println("BindException caught, attempting to handle..");
			try {
				int intRandPort = (int) ((Math.random()*25) + 5000);
				attemptConnect(intRandPort);
			} catch(Exception bEx){
				System.out.println("Error in port connection.");
			}
		} catch (IOException iEx){
			System.out.println("File error..");
		}
	}
	public void tellEveryone(String message){
		Iterator it = clientOutputStreams.iterator();
		while(it.hasNext()){
			try {
				PrintWriter writer = (PrintWriter) it.next();
				writer.println(message);
				writer.flush();
			} catch(Exception ex){
				ex.printStackTrace();
			}
		}
	}
}