FROM elasticsearch:5.2.1

MAINTAINER duylxbk57@gmail.com

COPY elasticsearch-analysis-vietnamese-5.2.1.zip /usr/share/elasticsearch/

RUN cd /usr/share/elasticsearch && \
	bin/plugin install file:elasticsearch-analysis-vietnamese-5.2.1.zip && \
	bin/plugin install analysis-icu
