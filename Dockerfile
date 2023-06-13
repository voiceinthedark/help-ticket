FROM alpine:latest

# Install MatchHostFsOwner. Replace X.X.X with an actual version.
# See https://github.com/FooBarWidget/matchhostfsowner/releases
ADD https://github.com/FooBarWidget/matchhostfsowner/releases/download/vX.X.X/matchhostfsowner-X.X.X-x86_64-linux.gz /sbin/matchhostfsowner.gz
RUN gunzip /sbin/matchhostfsowner.gz && \
    chown root: /sbin/matchhostfsowner && \
    chmod +x /sbin/matchhostfsowner
# RUN addgroup --gid 9999 app && \
#     adduser --uid 9999 --gid 9999 --disabled-password --gecos App app
## Or, on RHEL-based images:
# RUN groupadd --gid 9999 app && \
#   useradd --uid 9999 --gid 9999 app
# Or, on Alpine-based images:
RUN addgroup -g 9999 app && \
  adduser -G app -u 9999 -D app

ENTRYPOINT ["/sbin/matchhostfsowner"]
