import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
})
export class AppComponent {
  title = 'Angular';
  somos = 'Marc, Antonio, David';

  redirigirLogin(): void {
    window.location.href = 'http://localhost:4200/login';
  }
  redirigirgetAll(): void {
    window.location.href = 'http://localhost:4200/getAll';
  }
  redirigirfindOne(): void {
    window.location.href = 'http://localhost:4200/findOne';
  }
}
