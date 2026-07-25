import json, sys, hashlib, time
from base64 import urlsafe_b64decode
try:
    from argon2.low_level import Type, hash_secret_raw
except ImportError:
    hash_secret_raw = None

c = json.load(sys.stdin)
pad = "=" * ((4 - len(c["payload"]) % 4) % 4)
payload = urlsafe_b64decode(c["payload"] + pad)
prefix = payload + b":"
start = time.time()

for nonce in range(10_000_000):
    candidate = prefix + str(nonce).encode()
    if c["algo"] == "argon2id":
        digest = hash_secret_raw(candidate, bytes(8),
            time_cost=c["params"]["iterations"], memory_cost=c["params"]["memorySize"],
            parallelism=c["params"]["parallelism"], hash_len=c["params"]["hashLength"], type=Type.ID)
    else:
        digest = hashlib.sha256(candidate).digest()
    zeros = 0
    for b in digest:
        if b == 0: zeros += 8
        else:
            for i in range(7, -1, -1):
                if b & (1 << i): break
                zeros += 1
            break
    if zeros >= c["bits"]:
        print(json.dumps({"nonce": str(nonce), "solveTimeMs": int((time.time() - start) * 1000)}))
        sys.exit(0)

sys.exit(1)
