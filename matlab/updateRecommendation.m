function [  ] = updateRecommendation(my_predictions, id)

import java.sql.Connection;
import java.sql.*;

usuario = 'root';
contrasena = '';
host = 'localhost:3306';
database = 'ai13';
server = strcat('jdbc:mysql://', host,'/', database);

conexion = DriverManager.getConnection(server, usuario, contrasena);

s = conexion.createStatement();
fprintf('Se está actualizando la base de datos...\n');

for i=1:length(my_predictions)
    rec = my_predictions(i);
	%Con esta query insertamos recomendación si el usuario no posee ninguna o actualizamos la existente.
    try
    query= strcat('INSERT INTO recs (user_id, movie_id, rec_score) VALUES (', num2str(id), ', ', num2str(i), ', ', num2str(rec), ') ON DUPLICATE KEY UPDATE user_id =', num2str(id), ',movie_id =', num2str(i), ',rec_score =', num2str(rec));
    catch
    end
    
    s.executeUpdate(query);
    
end

fprintf('Base de datos actualizada correctamente.\n');

end

