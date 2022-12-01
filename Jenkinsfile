pipeline {
    agent any

    stages {
        stage ('docker build') {
            steps {
                script {
                    sh "sudo docker compose up -d"
                }
            }
        }

        stage ('docker tag') {
            steps {
                script{
                    sh "sudo docker tag bancodesangre-miservidor judiazgo7/bancodesangre:1.0.${BUILD_ID}"
                }
            }
        }

        stage ('docker login') {
            steps {
                script{
                    sh "sudo docker login -u 'judiazgo7' -p 'Juancd1974*' docker.io"
                }
            }
        }

        stage ('docker push') {
            steps {
                script{
                    sh "sudo docker push judiazgo7/bancodesangre:1.0.${BUILD_ID}"
                }
            }
        }
    }   
}



