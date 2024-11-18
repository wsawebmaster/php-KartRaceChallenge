-- Criar o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS kart_race;
USE kart_race;

-- Criar a tabela para os resultados da corrida
CREATE TABLE IF NOT EXISTS race_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pilot_code VARCHAR(10),
    pilot_name VARCHAR(50),
    lap_number INT,
    lap_time FLOAT(10,3),
    average_speed DECIMAL(5,2)
);

-- Inserir os dados da corrida
-- Inserir os dados da corrida com tempo convertido para segundos
INSERT INTO race_results (pilot_code, pilot_name, lap_number, lap_time, average_speed) VALUES
('038', 'F.MASSA', 1, (1*60 + 2 + 0.852), 44.275),
('033', 'R.BARRICHELLO', 1, (1*60 + 4 + 0.352), 43.243),
('002', 'K.RAIKKONEN', 1, (1*60 + 4 + 0.108), 43.408),
('023', 'M.WEBBER', 1, (1*60 + 4 + 0.414), 43.202),
('015', 'F.ALONSO', 1, (1*60 + 18 + 0.456), 35.47),
('038', 'F.MASSA', 2, (1*60 + 3 + 0.170), 44.053),
('033', 'R.BARRICHELLO', 2, (1*60 + 4 + 0.002), 43.48),
('002', 'K.RAIKKONEN', 2, (1*60 + 3 + 0.982), 43.493),
('023', 'M.WEBBER', 2, (1*60 + 4 + 0.805), 42.941),
('015', 'F.ALONSO', 2, (1*60 + 7 + 0.011), 41.528),
('038', 'F.MASSA', 3, (1*60 + 2 + 0.769), 44.334),
('033', 'R.BARRICHELLO', 3, (1*60 + 3 + 0.716), 43.675),
('002', 'K.RAIKKONEN', 3, (1*60 + 3 + 0.987), 43.49),
('023', 'M.WEBBER', 3, (1*60 + 4 + 0.287), 43.287),
('015', 'F.ALONSO', 3, (1*60 + 8 + 0.704), 40.504),
('011', 'S.VETTEL', 1, (3*60 + 31 + 0.315), 13.169),
('038', 'F.MASSA', 4, (1*60 + 2 + 0.787), 44.321),
('033', 'R.BARRICHELLO', 4, (1*60 + 4 + 0.010), 43.474),
('002', 'K.RAIKKONEN', 4, (1*60 + 3 + 0.076), 44.118),
('023', 'M.WEBBER', 4, (1*60 + 4 + 0.216), 43.335),
('015', 'F.ALONSO', 4, (1*60 + 20 + 0.050), 34.763),
('011', 'S.VETTEL', 2, (1*60 + 37 + 0.864), 28.435),
('011', 'S.VETTEL', 3, (1*60 + 18 + 0.097), 35.633);