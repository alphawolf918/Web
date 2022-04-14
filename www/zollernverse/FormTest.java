import javax.swing.*;
import java.applet.Applet;
import java.awt.*;
import java.awt.event.*;
import java.io.*;
import java.util.*;
import java.net.*;

public class FormTest extends Applet {
	TextArea incoming;
	TextField outgoing;
	BufferedReader reader;
	Socket sock;
	PrintWriter writer;
	
	public void init(){
		incoming = new TextArea(20,60);
		incoming.setEditable(false);
		outgoing = new TextField(40);
		Button sendButton = new Button("Send");
		sendButton.addActionListener(new SendButtonListener());
		add(incoming);
		add(outgoing);
		add(sendButton);
		setUpNetworking();
		Thread readerThread = new Thread(new IncomingReader());
		readerThread.start();
	}
	public void setUpNetworking(){
		try {
			sock = new Socket("127.0.0.1",5000);
			InputStreamReader streamReader = new InputStreamReader(sock.getInputStream());
			reader = new BufferedReader(streamReader);
			writer = new PrintWriter(sock.getOutputStream());
		} catch(IOException ex){
			ex.printStackTrace();
		}
	}
	public class SendButtonListener implements ActionListener {
		public void actionPerformed(ActionEvent event){
			try {
				String out = outgoing.getText();
				if(out != "" && out != null){
					writer.println(out);
					writer.flush();
				}
			} catch(Exception ex){
				ex.printStackTrace();
			}
		outgoing.setText("");
		outgoing.requestFocus();
		}
	}
	public class IncomingReader implements Runnable {
		public void run(){
			String message;
			try {
				while((message = reader.readLine()) != null){
					System.out.println(message);
					incoming.append(message+"\n");
				}
			} catch(Exception ex){
				ex.printStackTrace();
			}
		}
	}
}