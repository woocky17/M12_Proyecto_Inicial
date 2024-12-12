import { Component } from '@angular/core';
import { nurseService } from '../service/antonio.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
  providers: [nurseService]
})
export class LoginComponent {
  constructor(private nurseService: nurseService) { }
  login() {
    this.nurseService.login();
  }
  get form() {
    return this.nurseService.form;
  }
}
