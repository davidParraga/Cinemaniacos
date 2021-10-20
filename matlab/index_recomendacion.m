function my_predictions = index_recomendacion(id)

%% ============== Parte 6: Introducir nuestras puntuaciones ===============
%  Antes de comenzar a entrenar el algoritmo vamos a introducir nuestras
%  propias puntuaciones, para que en la parte final el algoritmo nos
%  muestre recomendaciones adecuadas a nuesrtras preferencias
%

%  Inicializo las puntuaciones

[R, Y, movieList] = getData();

%% ================== Parte 7: Entrenar el algoritmo ====================
%  Ahora se entrenará el algortimo de filtrado colaborativo para
% 1682 películas y 943 usuarios
%

fprintf('\nEntrenando el filtrado colaborativo...\n');

%  Valores utiles
num_users = size(Y, 2);
num_movies = size(Y, 1);
num_features = 19;


% Inicializa parámetros (Theta, X)
X = randn(num_movies, num_features);
Theta = randn(num_users, num_features);

initial_parameters = [X(:); Theta(:)];

% Selecciona las opciones de fmincg
options = optimset('MaxIter', 100);

% Ajusta regularización y ejecuta la optimización
lambda = 10;
theta = fmincg (@(t)(cofiCostFunc(t, Y, R, num_users, num_movies, ...
    num_features, lambda)), ...
    initial_parameters, options);

% Extrae X y Theta del vector resultante de la optimización (theta)
X = reshape(theta(1:num_movies*num_features), num_movies, num_features);
Theta = reshape(theta(num_movies*num_features+1:end), ...
    num_users, num_features);

fprintf('Aprendizaje del sistema de recomendación finalizado.\n');

%% ================== Parte 8: Generando recomendaciones ====================
%  Tras entrenar el algoritmo podemos realizar recomendaciones a partir de
%  la matriz de puntuaciones generada
%
p = X * Theta';
display(size(p(:,1)));
display(size(Y(:,1)==0));
my_predictions = p(:,1).*(Y(:,1)<5);
display(my_predictions);

updateRecommendation(my_predictions, id)
end
