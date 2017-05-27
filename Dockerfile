FROM elasticsearch:5.2.1

MAINTAINER duylxbk57@gmail.com

COPY elasticsearch-analysis-vietnamese-5.2.1.zip /usr/share/elasticsearch/

RUN cd /usr/share/elasticsearch && \
	bin/elasticsearch-plugin install file:///usr/share/elasticsearch/elasticsearch-analysis-vietnamese-5.2.1.zip && \
	bin/elasticsearch-plugin install analysis-icu
