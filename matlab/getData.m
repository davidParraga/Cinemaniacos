function [matrizR, matrizY, movieList] = getData()

import java.sql.Connection;
import java.sql.*;
import java.lang.Class;

javaaddpath([matlabroot,'/java/jarext/mysql-connector-java-5.1.15-bin.jar'])
database('ai13','root','','com.mysql.jdbc.Driver','jdbc:mysql://localhost:3306/ai13');
usuario = 'root';
contrasena = '';
host = 'localhost:3306';
database = 'ai13';
server = strcat('jdbc:mysql://', host,'/', database);

conexion = DriverManager.getConnection(server, usuario, contrasena);

s = conexion.createStatement();

movies = s.executeQuery('SELECT max(id) FROM movie');
numMovies = 0;

%Obtengo el número de películas
if (movies.next()) 
    numMovies = movies.getInt(1);
end

users = s.executeQuery('SELECT max(id) FROM users');
numUsers = 0;
	
%Obtengo el número de usuarios	
if (users.next()) 
    numUsers = users.getInt(1);
end

matrizY = zeros(numMovies, numUsers);
matrizR = zeros(numMovies, numUsers);

rs = s.executeQuery('SELECT id_user, id_movie, score FROM user_score');

%Relleno las matrices R e Y con los datos de la tabla user_score
while (rs.next())
    if(rs.getInt(2)<1683)
    matrizY(rs.getInt(2), rs.getInt(1)) = rs.getInt(3);
	matrizR(rs.getInt(2),rs.getInt(1)) = 1;
    end
end

allMovies = s.executeQuery('SELECT title, id FROM movie');
movieList = cell(numMovies, 1);

j = 0;

%Relleno la matriz movieList con los títulos de todas las películas
while(allMovies.next())
    j = j+1;
    title = allMovies.getString('title');
    movieList(j) = title;
end


end
