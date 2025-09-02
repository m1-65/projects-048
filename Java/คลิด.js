import javax.swing.*;
import java.awt.event.*;

public class ImageOnClick {
    public static void main(String[] args) {
        // สร้างหน้าต่าง JFrame
        JFrame frame = new JFrame("Click to Show Image");
        frame.setSize(400, 400);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setLayout(null);

        // สร้างปุ่ม
        JButton button = new JButton("แสดงภาพ");
        button.setBounds(140, 20, 120, 30);
        frame.add(button);

        // สร้าง JLabel สำหรับแสดงรูปภาพ (เริ่มต้นยังไม่แสดง)
        JLabel imageLabel = new JLabel();
        imageLabel.setBounds(50, 70, 300, 250);
        frame.add(imageLabel);

        // กำหนด Action ให้กับปุ่ม
        button.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                // โหลดรูปภาพ (ใส่ path รูปภาพให้ถูกต้อง)
                ImageIcon image = new ImageIcon("F1.jpg"); // หรือ .png ก็ได้
                imageLabel.setIcon(image);
            }
        });

        // แสดงหน้าต่าง
        frame.setVisible(true);
    }
}