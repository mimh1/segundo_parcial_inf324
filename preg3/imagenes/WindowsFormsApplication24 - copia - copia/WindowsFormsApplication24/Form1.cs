using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Imaging;
using System.Text;
using System.Windows.Forms;
using System.Data.SqlClient;


namespace WindowsFormsApplication24
{
    public partial class Form1 : Form
    {
        int Rm, Gm, Bm;
        int Rmc, Gmc, Bmc, L=3;
        string connectionString = "Data Source=localhost;Initial Catalog=bdcolores;User ID=inf324;Password='123456';";
        int clickx, clicky;
        int xRt, xGt, xBt;

        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            openFileDialog1.FileName = string.Empty;
            openFileDialog1.Filter = "Archivos JPG|*.JPG|Archivos BMP|*.bmp";
            openFileDialog1.ShowDialog();
            if (openFileDialog1.FileName != string.Empty)
            {
                Bitmap bmp = new Bitmap(openFileDialog1.FileName);
                pictureBox1.Image = bmp;
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            c = bmp.GetPixel(10, 10);
            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();
        }

        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            c = bmp.GetPixel(e.X, e.Y);
            Rm = c.R;
            Gm = c.G;
            Bm = c.B;
            Rmc = 0; Gmc = 0; Bmc = 0;
            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();
            clickx = e.X;
            clicky = e.Y;
            for (int i=e.X-((int)L/2);i<e.X+((int)L/2);i++)
                for (int j = e.Y - ((int)L / 2); j < e.Y + ((int)L / 2); j++)
                {
                    c = bmp.GetPixel(i, j);
                    Rmc = Rmc + c.R; Gmc = Gmc + c.G; Bmc = Bmc + c.B;
                }
            Rmc = (int)Rmc / (L*L);
            Gmc = (int)Gmc / (L*L);
            Bmc = (int)Bmc / (L*L);
            textBox1.Text = textBox1.Text +" "+Rmc.ToString();
            textBox2.Text = textBox2.Text +" "+Gmc.ToString();
            textBox3.Text = textBox3.Text +" "+Bmc.ToString();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            using (SqlConnection connection = new SqlConnection(connectionString))
            {
                connection.Open();

                // Insertar el color en la base de datos
                string insertQuery = "INSERT INTO colores (r, g, b, x, y) VALUES (@r, @g, @b, @x, @y)";

                using (SqlCommand insertCommand = new SqlCommand(insertQuery, connection))
                {
                    insertCommand.Parameters.AddWithValue("@r", Rm);
                    insertCommand.Parameters.AddWithValue("@g", Gm);
                    insertCommand.Parameters.AddWithValue("@b", Bm);

                    insertCommand.Parameters.AddWithValue("@x", clickx);
                    insertCommand.Parameters.AddWithValue("@y", clicky);

                    insertCommand.ExecuteNonQuery();
                }
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
            int Rt, Gt, Bt;
            Color c = new Color();
            GetLastColorFromDatabase0(out xRt, out xGt, out xBt);
            for (int i = 0; i < bmp.Width - L; i = i + L)
                for (int j = 0; j < bmp.Height - L; j = j + L)
                {
                    Rt = 0; Gt = 0; Bt = 0;
                    for (int o = i; o < i + L; o++)
                        for (int p = j; p < j + L; p++)
                        {
                            c = bmp.GetPixel(o, p);
                            Rt = Rt + c.R;
                            Gt = Gt + c.G;
                            Bt = Bt + c.B;
                        }
                    Rt = Rt / (L * L); Gt = Gt / (L * L); Bt = Bt / (L * L);
                    if (((xRt - 10 < Rt) && (Rt < xRt + 10))
                        && ((xGt - 10 < Gt) && (Gt < xGt + 10))
                        && ((xBt - 10 < Bt) && (Bt < xBt + 10)))
                    {
                        for (int o = i; o < i + L; o++)
                            for (int p = j; p < j + L; p++)
                            {
                                bmp2.SetPixel(o, p, Color.Black);
                            }
                    }
                    else
                    {
                        for (int o = i; o < i + L; o++)
                            for (int p = j; p < j + L; p++)
                            {
                                c = bmp.GetPixel(o, p);
                                bmp2.SetPixel(o, p, Color.FromArgb(c.R, c.G, c.B));
                            }
                    }
                }
            pictureBox1.Image = bmp2;
        }
        private void button6_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            int[] lastColorsArray = GetLastColorsFromDatabase();

            for (int m = 0; m < 8; m += 3)
            {
                int rx = lastColorsArray[m];
                int gx = lastColorsArray[m + 1];
                int bx = lastColorsArray[m + 2];

                for (int i = 0; i < bmp.Width - L; i = i + L)
                {
                    for (int j = 0; j < bmp.Height - L; j = j + L)
                    {
                        int Rt = 0, Gt = 0, Bt = 0;

                        for (int o = i; o < i + L; o++)
                        {
                            for (int p = j; p < j + L; p++)
                            {
                                c = bmp.GetPixel(o, p);
                                Rt = Rt + c.R;
                                Gt = Gt + c.G;
                                Bt = Bt + c.B;
                            }
                        }
                        Rt = Rt / (L * L);
                        Gt = Gt / (L * L);
                        Bt = Bt / (L * L);

                        if (((rx - 10 < Rt) && (Rt < rx + 10))
                            && ((gx - 10 < Gt) && (Gt < gx + 10))
                            && ((bx - 10 < Bt) && (Bt < bx + 10)))
                        {
                            for (int o = i; o < i + L; o++)
                            {
                                for (int p = j; p < j + L; p++)
                                {
                                    bmp2.SetPixel(o, p, Color.Black);
                                }
                            }
                        }
                        else
                        {
                            for (int o = i; o < i + L; o++)
                            {
                                for (int p = j; p < j + L; p++)
                                {
                                    c = bmp.GetPixel(o, p);
                                    bmp2.SetPixel(o, p, Color.FromArgb(c.R, c.G, c.B));
                                }
                            }
                        }
                    }
                }
                bmp = bmp2;
            }
            pictureBox1.Image = bmp2;
        }
        private int[] GetLastColorsFromDatabase()
        {
            int[] lastColors = new int[9]; // Crear un array de 9 elementos (3 colores x 3 canales)

            // Realizar la conexión a la base de datos y obtener los últimos tres colores almacenados
            using (SqlConnection connection = new SqlConnection(connectionString))
            {
                connection.Open();
                string query = "SELECT TOP 3 r, g, b FROM colores ORDER BY id DESC";
                using (SqlCommand command = new SqlCommand(query, connection))
                {
                    using (SqlDataReader reader = command.ExecuteReader())
                    {
                        int index = 0;

                        while (reader.Read())
                        {
                            lastColors[index++] = Convert.ToInt32(reader["r"]);
                            lastColors[index++] = Convert.ToInt32(reader["g"]);
                            lastColors[index++] = Convert.ToInt32(reader["b"]);
                        }
                    }
                }
            }

            // Rellenar con colores predeterminados si no hay tres colores en la base de datos
            while (lastColors.Length < 9)
            {
                Array.Resize(ref lastColors, lastColors.Length + 1);
                lastColors[lastColors.Length - 1] = 15;
            }

            return lastColors;
        }

        private void GetLastColorFromDatabase0(out int r, out int g, out int b)
        {
            // Realizar la conexión a la base de datos y obtener el último color almacenado
            using (SqlConnection connection = new SqlConnection(connectionString))
            {
                connection.Open();

                string query = "SELECT TOP 1 r, g, b FROM colores ORDER BY id DESC";

                using (SqlCommand command = new SqlCommand(query, connection))
                {
                    using (SqlDataReader reader = command.ExecuteReader())
                    {
                        if (reader.Read())
                        {
                            r = Convert.ToInt32(reader["r"]);
                            g = Convert.ToInt32(reader["g"]);
                            b = Convert.ToInt32(reader["b"]);
                        }
                        else
                        {
                            // Establecer un color predeterminado si no hay colores en la base de datos
                            r = 255;
                            g = 255;
                            b = 255;
                        }
                    }
                }
            }
        }
    }
}
