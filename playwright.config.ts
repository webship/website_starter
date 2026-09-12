import type { LaunchOptions, BrowserContextOptions } from 'playwright';

type BrowserName = 'chromium' | 'firefox' | 'webkit';

const browser = (process.env.BROWSER || 'chromium') as BrowserName;

interface PlaywrightConfig {
  browser: BrowserName;
  launchOptions: LaunchOptions;
  contextOptions: BrowserContextOptions;
}

const config: PlaywrightConfig = {
  browser,
  launchOptions: {
    headless: true,
    args: browser === 'chromium' ? ['--no-sandbox', '--disable-dev-shm-usage', '--ignore-certificate-errors'] : [],
  },
  contextOptions: {
    viewport: { width: 1200, height: 900 },
    ignoreHTTPSErrors: true,
  },
};

export = config;
