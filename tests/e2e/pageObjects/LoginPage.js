import { BASE_URL } from "../utils/constants";

export class LoginPage {
    constructor(page) {
        this.page = page;
        this.url = `${BASE_URL}/login`;
        this.emailField = this.page.getByRole("textbox", { name: "Email" });
        this.passwordField = this.page.getByRole("textbox", {
            name: "Password",
        });
        this.loginBtn = this.page.getByRole("button", { name: "Log in" });
    }

    async navigate() {
        await this.page.goto(this.url);
    }

    async login(email, password) {
        await this.emailField.fill(email);
        await this.passwordField.fill(password);
        await this.loginBtn.click();
    }
}
