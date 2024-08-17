# Utilise une version spécifique de l'image Nginx comme image de base
FROM nginx:1.22.1

# Configure le fuseau horaire
ENV TZ=${TZ:-Europe/Paris}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN rm /etc/nginx/conf.d/default.conf

# Met à jour les paquets et installe nginx-extras
RUN apt-get update && apt-get install -y nginx-extras

# Nettoie les fichiers temporaires pour réduire la taille de l'image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*