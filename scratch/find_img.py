import urllib.request, re

url = 'https://unsplash.com/photos/a-silver-minivan-parked-on-the-side-of-the-road-gtQTtlm-Jhk'
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
try:
    with urllib.request.urlopen(req, timeout=5) as resp:
        html = resp.read().decode('utf-8', errors='ignore')
        m = set(re.findall(r'https://images\.unsplash\.com/photo-[a-zA-Z0-9\-]+', html))
        for img in list(m)[:5]:
            print('Image:', img)
except Exception as e:
    print('Error:', e)

