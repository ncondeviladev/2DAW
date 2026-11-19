FROM alpine:latest
RUN apk add --no-cache git
WORKDIR /app
COPY info.txt .
ENV AUTOR="Noe Conde Vila"
EXPOSE 8083
CMD ["tail", "-f", "info.txt"]

