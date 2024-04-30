import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DashCategoriesComponent } from './dash-categories.component';

describe('DashCategoriesComponent', () => {
  let component: DashCategoriesComponent;
  let fixture: ComponentFixture<DashCategoriesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DashCategoriesComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(DashCategoriesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
